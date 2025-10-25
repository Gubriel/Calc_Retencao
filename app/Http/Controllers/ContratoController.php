<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContratoController extends Controller
{
    public function listarContratos($id_cliente)
    {
        $headers = [
            'Authorization' => 'Basic ' . base64_encode(env('IXC_API_AUTH')),
            'ixcsoft' => 'listar',
            'Content-Type' => 'application/json',
        ];

        $body = [
            "qtype" => "cliente_contrato.id_cliente",
            "query" => $id_cliente,
            "oper" => "=",
            "page" => "1",
            "rp" => "20",
            "sortname" => "cliente_contrato.id",
            "grid_param" => '[{"TB":"cliente_contrato.status","OP":"=","P":"A"}]',
            "sortorder" => "asc"
        ];

        $response = Http::withHeaders($headers)
            ->post(env('IXC_API_URL') . '/cliente_contrato', $body);

        if ($response->failed()) {
            return back()->withErrors(['msg' => 'Erro ao consultar contratos.']);
        }

        $data = $response->json();

        return view('contratos', [
            'contratos' => $data['registros'] ?? [],
            'id_cliente' => $id_cliente,
        ]);
    }
}
