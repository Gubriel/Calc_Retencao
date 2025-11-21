<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlanoController extends Controller
{
    public function detalhesPlano(Request $request)
    {

        $id = $request->input('id');
        $id_cliente = $request->input('id_cliente');
        $nome = $request->input('nome');

        $headers = [
            'Authorization' => 'Basic ' . base64_encode(env('IXC_API_AUTH')),
            'ixcsoft' => 'listar',
            'Content-Type' => 'application/json',
        ];

        $bodyFaturas = [
            'qtype' => 'fatura.id_contrato',
            'query' => $id,
            'oper' => '=',
            'page' => '1',
            'rp' => '20000',
            'sortorder' => 'desc'
        ];

        $bodyReceber = [
            'qtype' => 'fn_areceber.id_cliente',
            'query' => $id_cliente,
            'oper' => '=',
            'page' => '1',
            'rp' => '20',
            'sortname' => 'fn_areceber.id',
            'sortorder' => 'desc',
            'grid_param' => '[{"TB":"fn_areceber.status", "OP":"=", "P":"A"}]'
        ];

        $bodyOS = [
            'qtype' => 'su_oss_chamado.id_contrato_kit',
            'query' => '256674',
            'oper' => '=',
            'page' => '1',
            'rp' => '20',
            'sortname' => 'su_oss_chamado.id',
            'sortorder' => 'desc',
            'grid_param' => '[{"TB":"su_oss_chamado.id_assunto", "OP":"=", "P":"17"},{"TB":"su_oss_chamado.status", "OP":"=", "P":"F"},{"TB":"su_oss_chamado.tipo", "OP":"=", "P":"C"}]'
        ];

        // Buscar os dados de faturas
        $responseFaturas = Http::withHeaders($headers)
            ->withOptions(['verify' => false])
            ->post(env('IXC_API_URL') . '/fatura', $bodyFaturas);

        $responseReceber = Http::withHeaders($headers)
            ->withOptions(['verify' => false])
            ->post(env('IXC_API_URL') . '/fn_areceber', $bodyReceber);

        $responseOS = Http::withHeaders($headers)
            ->withOptions(['verify' => false])
            ->post(env('IXC_API_URL') . '/su_oss_chamado', $bodyOS);

        if ($responseFaturas->failed()) {
            return back()->withErrors(['msg' => 'Erro ao consultar contratos.']);
        }

        if ($responseReceber->failed()) {
            return back()->withErrors(['msg' => 'Erro ao consultar as faturas.']);
        }

        if ($responseOS->failed()) {
            return back()->withErrors(['msg' => 'Erro ao consultar as OSs.']);
        }

        $dataFaturas = $responseFaturas->json();
        $faturas = $dataFaturas['registros'] ?? [];

        $dataReceber = $responseReceber->json();
        $receber = $dataReceber['registros'] ?? [];

        $dataOS = $responseOS->json();
        $oss = $dataOS['registros'] ?? [];

        if ($receber == []) {
            $qntd_atrasos = 0;
        } else {
            $faturasAbertas = collect($receber);
            $faturasContrato = collect($faturas);
            $idsAbertos = $faturasAbertas->pluck('id')->toArray();
            $filtraAbertas = $faturasContrato->filter(function ($faturas) use ($idsAbertos) {
                return in_array($faturas['id_receber'], $idsAbertos);
            });
            $qntd_atrasos = $filtraAbertas->count();
        }

        // Calculos de Rentabiliade

        $base = collect($faturas)->count('valor_total');
        $qntd_visitas = collect($oss)->count('id');

        $tkt_medio = 111;
        $tx_churn = 1.25/100;
        $mrg_contrib = 75/100;
        $vis_tecnica = 73.03;
        $cobranca = 5.36;
        $equipamentos = 250;
        $ativacao = 200;
        $tx_retencao = $request->input('tx_retencao') / 100;

        $ltv = ($tkt_medio*$mrg_contrib)/$tx_churn;
        $lt = 1/$tx_churn;
        $cac = $equipamentos+$ativacao;
        $total_suporte = $qntd_visitas * $vis_tecnica;
        $total_cobranca = $qntd_atrasos * $cobranca;
        $media = collect($faturas)->pluck('valor_total')
            ->map(fn($v) => (float) $v) // float
            ->avg();

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

        // Retorna
        return view('plano-detalhe', compact('faturas', 'media', 'nome', 'base', 'qntd_visitas', 'qntd_atrasos', 'retencao', 'mensalidades', 'movel_gratis', 'sva_gratis'));
    }
}
