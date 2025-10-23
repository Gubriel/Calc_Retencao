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
                Calular retenção
            </h1>

            {{-- Exibir dados do cliente --}}
            <div class="flex space-x-3 mb-6">
                <div>
                    <label class="block text-red-900 font-semibold">Tempo de base</label>
                    <input type="text" nome="cliente_nome" class="w-16 px-2 py-2 rounded bg-gray-200" disabled>
                </div>
            </div>
            <div class="flex space-x-3 mb-6">
                <div>
                    <label class="block text-red-900 font-semibold">Qntd. de visitas</label>
                    <input type="text" name="cpf_cnpj" value="" class="w-16 px-2 py-2 rounded bg-gray-200" disabled>
                </div>
            </div>
            <div class="flex space-x-3 mb-6">
                <div>
                    <label class="block text-red-900 font-semibold">Pagamentos em atraso</label>
                    <input type="text" value="" class="w-16 px-2 py-2 rounded bg-gray-200" disabled>
                </div>
            </div>
            <div>
                <label class="block text-red-900 font-semibold">Receita média</label>
                <input id="planoField" type="text" value="" class="w-full px-2 py-2 rounded bg-gray-200" disabled>
            </div>
            <div class="flex space-x-3 mb-6">
                <div>
                    <label class="block text-red-900 font-semibold">Saldo Restante</label>
                    <input id="dadosField" type="" class="w-32 px-2 py-2 rounded bg-gray-200" disabled>
                </div>
                <div>
                    <label class="block text-red-900 font-semibold">Expira em</label>
                    <input id="expiraField" type="text" value="" class="w-32 px-2 py-2 rounded bg-gray-200" disabled>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="px-6 py-2 rounded-lg bg-red-500 text-white font-semibold hover:bg-red-600">
                    Confirmar
                </button>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
