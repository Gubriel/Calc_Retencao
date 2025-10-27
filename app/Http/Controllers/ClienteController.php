<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClienteController extends Controller
{
    public function index()
    {
        return view('buscar-cliente');
    }

    public function buscarCliente(Request $request)
    {
        $cpfCnpj = $request->input('cpf_cnpj');

        $headers = [
            'Authorization' => 'Basic ' . base64_encode(env('IXC_API_AUTH')),
            'ixcsoft' => 'listar',
            'Content-Type' => 'application/json',
        ];

        $body = [
            'qtype' => 'cliente.cnpj_cpf',
            'query' => maskDocumento($cpfCnpj),
            'oper' => '=',
            'page' => '1',
            'rp' => '20000',
            'sortname' => 'cliente.id',
            'sortorder' => 'asc',
            'grid_param' => '[{"TB":"cliente.ativo","OP":"=","P":"S"}]'
        ];

        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'aplication/json')
            ->post(env('IXC_API_URL') . '/cliente');

        if ($response->failed()) {
            return back()->withErrors(['msg' => 'Erro ao consultar a API de cliente.']);
        }

        $data = $response->json();

        if (empty($data['registros'])) {
            return back()->withErrors(['msg' => 'Nenhum cliente encontrado com esse CPF/CNPJ.']);
        }

        $cliente = $data['registros'][0];

        session([
            'id_cliente' => $cliente['id'],
            'nome_cliente' => $cliente['razao'] ?? $cliente['fantasia']
        ]);

        return redirect()->route('contratos.listar');
    }
}
