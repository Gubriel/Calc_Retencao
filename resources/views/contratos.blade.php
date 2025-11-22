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
</head>
    <body class="bg-light">
        <div class="container w-full py-5">

            <a href="{{ route('cliente.form') }}" class="btn absolute top-4 left-4 flex items-center space-x-2 text-white font-semibold btn-danger">← Voltar</a>
            <a href="{{ route('sair') }}" class="btn absolute top-4 right-4 flex items-center space-x-2 text-white font-semibold btn-danger">Sair</a>

            <div class="p-1 mb-6 mt-5 rounded shadow">
                <h1 class="text-2xl p-3 font-bold text-center text-red-900">{{ $id_cliente }} - {{ $nomeCliente }}</h1>
                <div class="text-left flex pr-6 pl-6 pt-3 text-xl text-red-900">
                    <div class="row p-1 col-6 bg-gray-300 justify-content-between">
                        <div class="col-sm-6">CPF/CNPJ: 112.321.435-63</div>
                        <div class="col-md-6">Endereço: Rua rer</div>
                        <div class="col-md-6">Numero: 71</div>
                        <div class="col-md-6">CEP: 34310-001</div>
                        <div class="col-md-6">Bairro: rewdfdsx</div>
                        <div class="col-md-6">Condominio: 34223</div>
                        <div class="col-md-6">Cidade: ssssssss</div>
                        <div class="col-md-6">Complemento: relldlfms,dm</div>
                    </div>
                    <div class="row p-1 col-6 justify-content-between">
                        <div class="col-md-6">Data de cadastro:</div>
                        <div class="col-md-6">Total de parcelas em atraso:</div>
                        <div class="col-md-6">Total de Contratos de internet ativos:</div>
                    </div>
                </div>
                <div class="text-center itens-center flex pr-6 pl-6 pt-3 text-xl text-black">
                    <div class="row p-1 col-md-12 bg-green-300 justify-content-between">
                        <div class="col-md-12">Reter cliente</div>
                    </div>
                </div>
            </div>

            @if(empty($contratos))
                <div class="alert alert-warning">Nenhum contrato ativo encontrado.</div>
            @else
                <div class="p-1 bg-red-900 rounded shadow">
                    <table class="table caption-top table-bg-red table-borderless mb-0 table-striped table-hover">
                        <caption class="text-white text-xl font-semibold text-center">Planos ativos</caption>
                        <thead class="table-active">
                            <tr>
                                <th>ID</th>
                                <th>Plano</th>
                                <th>Taxa de Retenção</th>
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
                                    <form action="{{ route('cliente.detalhes') }}" method="POST" class="m-0 p-0">
                                        <td>
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $contrato['id'] }}">
                                            <input type="hidden" name="id_cliente" value="{{ $id_cliente }}">
                                            <input type="hidden" name="nome" value="{{ $contrato['contrato'] }}">
                                            <button type="submit" class="text-red-700 hover:text-red-900 font-semibold w-full text-left">
                                                {{ $contrato['contrato'] ?? '-' }}
                                            </button>
                                        </td>
                                        <td>
                                            <select class="form-select w-32" name="tx_retencao" id="inputGroupSelect01">
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
                                    <td>{{ maskTipo($contrato['tipo']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </body>
</html>
