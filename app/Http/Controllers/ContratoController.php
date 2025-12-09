<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContratoController extends Controller
{
    public function listarContratos()
    {
        $cliente = session('dados_cliente');

        $headers = [
            'Authorization' => 'Basic ' . base64_encode(env('IXC_API_AUTH')),
            'ixcsoft' => 'listar',
            'Content-Type' => 'application/json',
        ];

        // Buscar contratos
        $bodyContratos = [
            "qtype" => "cliente_contrato.id_cliente",
            "query" => $cliente['id'],
            "oper" => "=",
            "page" => "1",
            "rp" => "50",
            "sortname" => "cliente_contrato.id",
            "sortorder" => "asc"
        ];

        $responseContratos = Http::withHeaders($headers)
            ->withOptions(['verify' => false])
            ->post(env('IXC_API_URL') . '/cliente_contrato', $bodyContratos);

        if ($responseContratos->failed()) {
            return back()->withErrors(['msg' => 'Erro ao consultar contratos.']);
        }

        $contratos = collect($responseContratos->json()['registros'] ?? [])
                        ->where('status', 'A');

        // Buscar A Receber
        $bodyReceber = [
            'qtype' => 'fn_areceber.id_cliente',
            'query' => $cliente['id'],
            'oper' => '=',
            'page' => '1',
            'rp' => '20',
            'sortorder' => 'desc',
            'grid_param' => '[{"TB":"fn_areceber.status", "OP":"=", "P":"A"}]'
        ];

        $responseReceber = Http::withHeaders($headers)
            ->withOptions(['verify' => false])
            ->post(env('IXC_API_URL') . '/fn_areceber', $bodyReceber);

        $aReceber = $responseReceber->json()['registros'] ?? [];

        // Buscar faturas de todos os contratos
        $todasFaturas = collect();

        foreach ($contratos as $contrato) {

            $bodyFaturas = [
                'qtype' => 'fatura.id_contrato',
                'query' => $contrato['id'],
                'oper' => '=',
                'page' => '1',
                'rp' => '5000',
                'sortorder' => 'desc'
            ];

            $responseFaturas = Http::withHeaders($headers)
                ->withOptions(['verify' => false])
                ->post(env('IXC_API_URL') . '/fatura', $bodyFaturas);

            if ($responseFaturas->successful()) {
                $faturas = $responseFaturas->json()['registros'] ?? [];
                $todasFaturas = $todasFaturas->merge($faturas);
            }
        }

        // dd($todasFaturas);

        return view('contratos', [
            'contratos' => $contratos,
            'count_contratos' => $contratos->count(),
            'aReceber' => $aReceber,
            'count_aReceber' => count($aReceber),
            'faturas' => $todasFaturas,
            'count_faturas' => $todasFaturas->count(),
        ]);
    }
}
