<!DOCTYPE html>
<html lang="pt-BR">

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contratos do Cliente</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $cliente = session('dados_cliente');
    @endphp

    <style>
        body {
            background: #f3f5f7;
        }
        .card {
            border-radius: 12px;
        }
        table th {
            white-space: nowrap;
        }
        table td {
            vertical-align: middle;
        }
        .badge {
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-white shadow-sm mb-4 px-4">
        <div class="container-fluid d-flex justify-content-between">
            <a href="{{ route('cliente.form') }}" class="btn btn-outline-danger">← Voltar</a>
            <a class="btn btn-outline-danger" href="{{ route('sair') }}">Sair</a>
        </div>
    </nav>
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="fw-bold text-red-700 mb-3">
                    {{ $cliente['id'] }} - {{ $cliente['razao'] }}
                </h1>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <p><strong>CPF/CNPJ:</strong> {{ $cliente['cnpj_cpf'] }}</p>
                        <p><strong>Endereço:</strong> {{ $cliente['endereco'] }}</p>
                        <p><strong>Bairro:</strong> {{ $cliente['bairro'] }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>CEP:</strong> {{ $cliente['cep'] }}</p>
                        <p><strong>Numero:</strong> {{ $cliente['numero'] ?? 'N/A' }}</p>
                        <p><strong>Cidade:</strong> {{ maskCidade($cliente['cidade']) }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Complemento:</strong> {{ $cliente['complemento'] ?? 'Não informado' }}</p>
                        <p><strong>Data de cadastro:</strong> {{ maskData($cliente['data_cadastro']) }}</p>
                        <p><strong>WhatsApp:</strong> {{ $cliente['whatsapp'] }}</p>
                    </div>
                </div>
                <hr>
                <div class="row mt-2 text-center">
                    <div class="col-md-4">
                        <p><strong>Total de parcelas a receber:</strong> {{ $count_aReceber }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Numero de contratos ativos:</strong> {{ $count_contratos }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Tempo de Base:</strong> {{ maskMeses($count_faturas) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center fw-bold mt-2">
            <input type="text" value="Reter Cliente" class="w-full bg-success text-lg text-white text- font-semibold px-2 py-2 text-center rounded bg-gray-200" disabled>
        </div>

        <!-- TABELA DE PLANOS ATIVOS -->
        <div class="card mt-2 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold text-center text-red-700 mb-3">CONTRATOS ATIVOS</h5>
                @if (empty($contratos))
                    <div class="alert text-center bg-gray-200">Nenhum contrato ativo no momento.</div>
                @else
                    <table class="table table-hover align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>ID</th>
                                <th>Plano</th>
                                <th>Retenção</th>
                                <th>Ativação</th>
                                <th>Endereço</th>
                                <th>Número</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contratos as $contrato)
                                <tr>
                                    <td>{{ $contrato['id'] ?? '-' }}</td>
                                    <form action="{{ route('cliente.detalhes') }}" method="POST" class="m-0 p-0">
                                        <td>
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $contrato['id'] }}">
                                            <input type="hidden" name="id_cliente" value="{{ $cliente['id'] }}">
                                            <input type="hidden" name="nome" value="{{ $contrato['contrato'] }}">
                                            <button type="submit" class="hover:text-red-700 font-semibold w-full text-left">
                                                {{ $contrato['contrato'] ?? '-' }}
                                            </button>
                                        </td>
                                        <td>
                                            <select class="form-select w-32" name="tx_retencao">
                                                <option value="5">5%</option>
                                                <option value="7.5">7,5%</option>
                                                <option selected value="10">10%</option>
                                                <option value="12.5">12,5%</option>
                                            </select>
                                        </td>
                                    </form>
                                    <td>{{ maskData($contrato['data_ativacao']) ?? 'N/A' }}</td>
                                    <td>{{ $contrato['endereco'] ?? $contrato['endereco_novo'] }}</td>
                                    <td>{{ $contrato['numero'] ?? $contrato['numero_novo'] }}</td>
                                    <td>{{ $contrato['bairro'] ?? $contrato['bairro_novo'] }}</td>
                                    <td>{{ maskCidade($contrato['cidade']) ?? 'N/A' }}</td>
                                    <td><span class="badge bg-secondary">{{ maskTipo($contrato['tipo']) }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
