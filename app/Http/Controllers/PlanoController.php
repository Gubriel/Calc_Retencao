<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlanoController extends Controller
{
    public function detalhesPlano(Request $request)
    {

        $id = $request->input('id');
        $nome = $request->input('nome');

        $headers = [
            'Authorization' => 'Basic ' . base64_encode(env('IXC_API_AUTH')),
            'ixcsoft' => 'listar',
            'Content-Type' => 'application/json',
        ];


        $body = [
            'qtype' => 'fatura.id_contrato',
            'query' => $id,
            'oper' => '=',
            'page' => '1',
            'rp' => '20',
            'sortorder' => 'desc'
        ];

        // Buscar os dados de faturas
        $response = Http::withHeaders($headers)
            ->post(env('IXC_API_URL') . '/fatura', $body);

        if ($response->failed()) {
            return back()->withErrors(['msg' => 'Erro ao consultar contratos.']);
        }

        $data = $response->json();
        $faturas = $data['registros'] ?? [];

        // Calculos de Rentabiliade

        $base = count($faturas);
        $qntd_visitas = 0;
        $qntd_atrasos = 0;

        $tkt_medio = 111;
        $tx_churn = 1.25/100;
        $mrg_contrib = 75/100;
        $vis_tecnica = 60;
        $cobranca = 15;
        $equipamentos = 250;
        $ativacao = 200;
        $tx_retencao = 10/100;

        $ltv = ($tkt_medio*$mrg_contrib)/$tx_churn;
        $lt = 1/$tx_churn;
        $cac = $equipamentos+$ativacao;
        $total_suporte = $qntd_visitas * $vis_tecnica;
        $total_cobranca = $qntd_atrasos * $cobranca;
        $media = collect($faturas)->pluck('valor_total')->avg();

        $ltv_cliente = $base*$media*$mrg_contrib;
        $ltv_perda = $ltv-$ltv_cliente;

        if ($media == 0) {
            $media = 1;
        }

        if (($cac+$total_cobranca+$total_suporte) >= $ltv_cliente) {
            $retencao = 'Não';
        } else {
            $retencao = 'Sim';
        }

        $mensalidades = round(($ltv_cliente/$media)*$tx_retencao);
        $movel_gratis = round(($ltv_cliente/39.9)*$tx_retencao);
        $sva_gratis = round(($ltv_cliente/44.9/1.5)*$tx_retencao);

        // Retorna para a view de detalhes
        return view('plano-detalhe', compact('faturas', 'media', 'nome', 'base', 'qntd_visitas', 'qntd_atrasos', 'retencao', 'mensalidades', 'movel_gratis', 'sva_gratis'));
    }
}
