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

        /*
        $bodyReceber = [
            'qtype' => 'fn_areceber.id_cliente',
            'query' => $cpfCnpj,
            'oper' => '>',
            'page' => '1',
            'rp' => '200',
            'sortname' => 'fn_areceber.id',
            'sortorder' => 'desc',
            'grid_param' => '[{"TB":"fn_areceber.status", "OP":"=", "P":"A"}]'
        ];

        $bodyOS = [
            'qtype' => 'su_oss_chamado.id_contrato_kit',
            'query' => '256674',
            'oper' => '=',
            'page' => '1',
            'rp' => '200',
            'sortname' => 'su_oss_chamado.id',
            'sortorder' => 'desc',
            'grid_param' => '[{"TB":"su_oss_chamado.id_assunto", "OP":"=", "P":"17"},{"TB":"su_oss_chamado.status", "OP":"=", "P":"F"},{"TB":"su_oss_chamado.tipo", "OP":"=", "P":"C"}]'
        ];*/

        $response = Http::withHeaders($headers)
            ->withOptions(['verify' => false])
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

        $bodyFaturas = [
            'qtype' => 'fatura.id_cliente',
            'query' => $cliente['id'],
            'oper' => '=',
            'page' => '1',
            'rp' => '20000',
            'sortorder' => 'desc'
        ];

        $responseFaturas = Http::withHeaders($headers)
            ->withOptions(['verify' => false])
            ->withBody(json_encode($body), 'aplication/json')
            ->post(env('IXC_API_URL') . '/faturas');

        session([
            'id_cliente' => $cliente['id'],
            'nome_cliente' => $cliente['razao'] ?? $cliente['fantasia']
        ]);

        return redirect()->route('contratos.listar');
    }
}
