<!-- File: resources/views/recargaerp.blade.php -->
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Retenção</title>
        {{-- Bootstrap + Tailwind --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body class="bg-white flex items-center justify-center h-screen relative">

        <div class="w-full max-w-lg p-6">

            {{-- Título dinâmico --}}
            <h1 class="text-2xl font-bold text-center mb-6 text-red-900">
                Possibilidade de retenção
            </h1>

            {{-- Exibir dados do cliente --}}
            <div class="flex items-center space-x-3 mb-4">
                <div class="flex p-2 items-center rounded bg-gray-100 space-x-3">
                    <div class="flex-colunm space-y-1">
                        <label class="block text-red-900 font-semibold">Tempo de base:</label>
                        <label class="block text-red-900 font-semibold">Qntd. de visitas:</label>
                        <label class="block text-red-900 font-semibold">Pagamentos em atraso:</label>
                        <label class="block text-red-900 font-semibold">Receita média:</label>
                    </div>
                    <div class="flex-colunm space-y-1">
                        <input type="text" nome="cliente_nome" value="16" class="block font-semibold w-16 text-center px-2 bg-white" disabled>
                        <input type="text" nome="cliente_nome" value="4" class="block font-semibold w-16 text-center px-2 bg-white" disabled>
                        <input type="text" nome="cliente_nome" value="0" class="block font-semibold w-16 text-center px-2 bg-white" disabled>
                        <input type="text" nome="cliente_nome" value="121" class="block font-semibold w-16 text-center px-2 bg-white" disabled>
                    </div>
                </div>
                <div class="flex p-2 items-center rounded bg-gray-100 space-x-3">
                    <div class="flex-colunm space-y-1">
                        <label class="block text-red-900 font-semibold">Ticket Médio:</label>
                        <label class="block text-red-900 font-semibold">Taxa de churn:</label>
                        <label class="block text-red-900 font-semibold">Margem de contribuição:</label>
                        <label class="block text-red-900 font-semibold">LTV:</label>
                    </div>
                    <div class="flex-colunm space-y-1">
                        <input type="text" nome="cliente_nome" value="16" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="4" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="0" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="121" class="block font-semibold w-16 text-center px-2 bg-white">
                    </div>
                </div>
            </div>
            {{-- <div class="flex space-x-3 mb-6">
                <label class="block text-red-900 font-semibold">Saldo Restante</label>
                <input type="text" nome="cliente_nome" value="16" class="w-16 px-2 rounded bg-gray-200" disabled>
            </div>
            <div class="flex space-x-3 mb-6">
                <label class="block text-red-900 font-semibold">Expira em</label>
                <input type="text" nome="cliente_nome" value="16" class="w-16 px-2 rounded bg-gray-200" disabled>
            </div> --}}
            <div class="text-center">
                <button type="submit" class="px-6 py-2 rounded-lg bg-red-500 text-white font-semibold hover:bg-red-600">
                    Calcular
                </button>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
