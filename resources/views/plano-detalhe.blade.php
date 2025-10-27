<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Busca Retenção</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="bg-light">
        <div class="container w-full max-w-2xl py-5">

            <a href="{{ route('cliente.form') }}" class="btn absolute top-4 left-4 flex items-center space-x-2 text-white font-semibold btn-danger">← Voltar</a>
            <a href="{{ route('sair') }}" class="btn absolute top-4 right-4 flex items-center space-x-2 text-white font-semibold btn-danger">Sair</a>

            <h1 class="text-2xl font-bold text-center mb-6 text-red-900">{{ $nome }}</h1>

            @if(empty($faturas))
                <div class="alert alert-warning">Erro: Nenhum dado encontrado.</div>
            @else
                <div class="p-4 bg-white rounded shadow">
                    <h1 class="text-2xl font-bold text-center mb-6 text-red-900">Dados do Plano</h1>
                    <hr class="mb-4">
                    <div class="mb-4 space-y-2">
                        <div>
                            <label class="block text-red-900 font-semibold">Base de Tempo</label>
                            <input type="text" nome="cliente_nome" value="{{ maskMeses($base) }}" class="w-full px-2 py-2 text-center rounded bg-gray-200" disabled>
                        </div>
                        @if ($qntd_visitas > 0)
                        <div>
                            <label class="block text-red-900 font-semibold">Qntd. de visitas técnicas</label>
                            <input type="text" nome="cliente_nome" value="{{ $qntd_visitas }}" class="w-full px-2 py-2 text-center rounded bg-gray-200" disabled>
                        </div>
                        @endif
                        @if ($qntd_atrasos > 0)
                        <div>
                            <label class="block text-red-900 font-semibold">Qntd. de atrasos</label>
                            <input type="text" nome="cliente_nome" value="{{ maskMeses($qntd_atrasos) }}" class="w-full px-2 py-2 text-center rounded bg-gray-200" disabled>
                        </div>
                        @endif
                        <div>
                            <label class="block text-red-900 font-semibold">Receita media</label>
                            <input type="text" nome="cliente_nome" value="R${{ number_format($media, 2, ',', '.') }}" class="w-full px-2 py-2 text-center rounded bg-gray-200" disabled>
                        </div>
                        @if($retencao == 'Não')
                            <div>
                                <label class="block text-red-900 font-semibold">Reter cliente:</label>
                                <input type="text" nome="cliente_nome" value="{{ $retencao }}" class="w-full bg-danger text-white font-semibold px-2 py-2 text-center rounded bg-gray-200" disabled>
                            </div>
                        @else
                            <div>
                                <label class="block text-red-900 font-semibold">Reter cliente:</label>
                                <input type="text" nome="cliente_nome" value="{{ $retencao }}" class="w-full bg-success text-white font-semibold px-2 py-2 text-center rounded bg-gray-200" disabled>
                            </div>
                            <hr class="my-4">
                            <h1 class="text-2xl font-bold text-center mb-6 text-red-900">Opções disponiveis</h1>
                            @if ($mensalidades > 0)
                                <div>
                                    <label class="block text-red-900 font-semibold">Mensalidades Grátis</label>
                                    <input type="text" nome="cliente_nome" value="{{ maskMeses($mensalidades) }}" class="w-full px-2 py-2 text-center rounded bg-gray-200" disabled>
                                </div>
                            @endif
                            @if ($movel_gratis > 0)
                                <div>
                                    <label class="block text-red-900 font-semibold">Plano Movel Grátis</label>
                                    <input type="text" nome="cliente_nome" value="{{ maskMeses($movel_gratis) }}" class="w-full px-2 py-2 text-center rounded bg-gray-200" disabled>
                                </div>
                            @endif
                            @if ($sva_gratis > 0)
                                <div>
                                    <label class="block text-red-900 font-semibold">SVAs Grátis</label>
                                    <input type="text" nome="cliente_nome" value="{{ maskMeses($sva_gratis) }}" class="w-full px-2 py-2 text-center rounded bg-gray-200" disabled>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
            </div>
        </div>
    </body>
</html>
