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

        $body = [
            "qtype" => "cliente_contrato.id_cliente",
            "query" => $cliente['id'],
            "oper" => "=",
            "page" => "1",
            "rp" => "20",
            "sortname" => "cliente_contrato.id",
            "grid_param" => '[{"TB":"cliente_contrato.status","OP":"=","P":"A"}]',
            "sortorder" => "asc"
        ];

        $bodyReceber = [
            'qtype' => 'fn_areceber.id_cliente',
            'query' => $cliente['id'],
            'oper' => '=',
            'page' => '1',
            'rp' => '20',
            'sortname' => 'fn_areceber.id',
            'sortorder' => 'desc',
            'grid_param' => '[{"TB":"fn_areceber.status", "OP":"=", "P":"A"}]'
        ];

        $responseReceber = Http::withHeaders($headers)
            ->withOptions(['verify' => false])
            ->post(env('IXC_API_URL') . '/fn_areceber', $bodyReceber);

        $response = Http::withHeaders($headers)
            ->withOptions(['verify' => false])
            ->post(env('IXC_API_URL') . '/cliente_contrato', $body);

        if ($response->failed()) {
            return back()->withErrors(['msg' => 'Erro ao consultar contratos.']);
        }

        $data = $response->json();
        $contratos = $data['registros'] ?? [];
        $count_contratos = count($data['registros'] ?? []);
        $dataReceber = $responseReceber->json();
        $aReceber = $dataReceber['registros'] ?? [];
        $count_aReceber = count($dataReceber['registros'] ?? []);

        return view('contratos', compact('contratos', 'count_contratos', 'count_aReceber'));
    }
}
