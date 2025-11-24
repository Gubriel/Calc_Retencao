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

            <div class="mt-5 flex-column itens-center rounded-top border-4 border-bottom-0 border-top-0 border-success shadow">
                <div class="text-center itens-center justify-center flex text-xl text-black">
                    <div class="p-2 col-md-12 bg-success justify-content-between">
                        <h1 class="text-2xl font-bold text-center text-white">{{ $id_cliente }} - {{ $nomeCliente }}</h1>
                    </div>
                </div>
                <div class="text-left justify-center flex p-3 text-xl">
                    <div class="row p-1 flex-col col-3">
                        <div>CPF/CNPJ: 112.321.435-63</div>
                        <div>Endereço: Rua rer</div>
                        <div>Numero: 71</div>
                    </div>
                    <div class="row p-1 flex-col col-3">
                        <div>Bairro: rewdfdsx</div>
                        <div>CEP: 34310-001</div>
                        <div>Condominio: 34223</div>
                    </div>
                    <div class="row p-1 flex-col col-3">
                        <div>Cidade: ssssssss</div>
                        <div>Complemento: relldlfms,dm</div>
                        <div>Data de cadastro: 90/12/1985</div>
                    </div>
                    <div class="row p-1 flex-col col-3">
                        <div>Total de parcelas em atraso: 4</div>
                        <div>Total de Contratos de internet ativos: 4</div>
                    </div>
                </div>
            </div>

            @if(empty($contratos))
                <div class="alert alert-warning">Nenhum contrato ativo encontrado.</div>
            @else
                <div class="p-1 bg-success shadow rounded-bottom">
                    <table class="table caption-top table-borderless mb-0">
                        <caption class="text-white text-xl mb-1 font-semibold text-center">Planos ativos</caption>
                        <thead class="table-success">
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
                                            <button type="submit" class="hover:text-red-900 font-semibold w-full text-left">
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
                    <div class="p-2 bg-success">
                        <h1 class="text-xl font-bold text-center text-white">Reter Cliente</h1>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </body>
</html>
