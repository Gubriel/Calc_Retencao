<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contratos do Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="bg-light">
        <div class="container w-full py-5">

            <a href="{{ route('cliente.form') }}" class="absolute top-4 left-4 flex items-center space-x-2 text-red-600 hover:text-red-800 font-semibold">← Voltar</a>

            <h1 class="text-2xl font-bold text-center mb-6 text-red-900">{{ $id_cliente }} - {{ $nomeCliente }}</h1>

            @if(empty($contratos))
                <div class="alert alert-warning">Nenhum contrato ativo encontrado.</div>
            @else
                <div class="p-4 bg-white rounded shadow">
                    <h1 class="text-xl font-semibold text-center mb-6">Planos ativos</h1>
                    <table class="table table-hover table-bordered bg-white shadow-sm">
                        <thead class="table-danger">
                            <tr>
                                <th>ID</th>
                                <th>Plano</th>
                                <th>Data de Ativação</th>
                                <th>Endereço</th>
                                <th>Numero</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($contratos as $contrato)
                            <tr>
                                <td>{{ $contrato['id'] ?? '-' }}</td>
                                <td>{{ $contrato['contrato'] ?? '-' }}</td>
                                <td>{{ maskData($contrato['data_ativacao']) ?? '-' }}</td>
                                <td>{{ $contrato['endereco'] ?? $contrato['endereco_novo'] }}</td>
                                <td>{{ $contrato['numero'] ?? $contrato['numero_novo'] }}</td>
                                <td>{{ $contrato['bairro'] ?? $contrato['bairro_novo'] }}</td>
                                <td>{{ maskCidade($contrato['cidade']) ?? '-' }}</td>
                                <td>{{ maskTipo($contrato['tipo']) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </body>
</html>
