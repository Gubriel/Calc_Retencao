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
        @vite('resources/css/app.css')
    </head>

    <body class="flex items-center justify-center min-h-screen py-10">
        <div class="w-full max-w-3xl p-3 bg-white shadow-2xl rounded-lg">
            <h1 class="text-3xl font-bold text-center mb-8 text-red-900">
            Possibilidade de Retenção
            </h1>
            <div class="flex flex-wrap gap-4 justify-center mb-3">
                <!-- bloco esquerdo -->
                <div class="flex p-4 bg-gray-100 rounded-lg space-x-3">
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
                <!-- bloco direito -->
                <div class="flex p-4 bg-gray-100 rounded-lg space-x-3">
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
            <!-- blocos de baixo -->
            <div class="flex flex-wrap gap-3 justify-center mb-3">
                <!-- bloco esquerdo -->
                <div class="flex p-4 bg-gray-100 mb-7 rounded-lg">
                    <div class="flex-colunm mr-2 space-y-1">
                        <label class="block text-red-900 font-semibold">LTV:</label>
                        <label class="block text-red-900 font-semibold">Perda LTV:</label>
                        <label class="block text-red-900 font-semibold">Retenção:</label>
                        <label class="block text-red-900 font-semibold">Taxa de Retenção:</label>
                        <label class="block text-red-900 font-semibold">Opção 1 - Mensalidades:</label>
                        <label class="block text-red-900 font-semibold">Opção 2 - Movel (MESES GRATIS):</label>
                        <label class="block text-red-900 font-semibold">Opção 3 - SVA (MESES GRATIS):</label>
                        <label class="block text-red-900 font-semibold">Opção 4 DOWNGRADE DE TICKET:</label>
                    </div>
                    <div class="flex-colunm space-y-1">
                        <input type="text" nome="cliente_nome" value="16" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="4" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="0" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="121" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="16" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="4" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="0" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="121" class="block font-semibold w-16 text-center px-2 bg-white">
                    </div>
                </div>
                <!-- bloco direito -->
                <div class="flex p-4 bg-gray-100 mb-7 rounded-lg">
                    <div class="flex-colunm mr-2 space-y-1">
                        <label class="block text-red-900 font-semibold">LT:</label>
                        <label class="block text-red-900 font-semibold">LTV:</label>
                        <label class="block text-red-900 font-semibold">Retenção:</label>
                        <label class="block text-red-900 font-semibold">Taxa de Retenção:</label>
                        <label class="block text-red-900 font-semibold">Opção 1:</label>
                        <label class="block text-red-900 font-semibold">Opção 2:</label>
                        <label class="block text-red-900 font-semibold">Opção 3:</label>
                        <label class="block text-red-900 font-semibold">Opção 4:</label>
                    </div>
                    <div class="flex-colunm space-y-1">
                        <input type="text" nome="cliente_nome" value="16" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="4" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="0" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="121" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="16" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="4" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="0" class="block font-semibold w-16 text-center px-2 bg-white">
                        <input type="text" nome="cliente_nome" value="121" class="block font-semibold w-16 text-center px-2 bg-white">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="px-16 py-2 rounded-lg bg-red-500 text-white font-semibold hover:bg-red-600">
                Calcular
                </button>
            </div>
        </div>
    </body>
</html>
