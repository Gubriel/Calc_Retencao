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
    <nav class="navbar navbar-light bg-white shadow-sm mb-4 px-4">
        <div class="container-fluid d-flex justify-content-end">
            <a class="btn btn-outline-danger" href="{{ route('sair') }}">Sair</a>
        </div>
    </nav>
<div class="container w-full max-w-2xl py-5">
    <h1 class="text-2xl font-bold text-center mb-6 mt-5 text-red-700">Consultar Cliente</h1>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('cliente.buscar') }}" method="POST" class="p-4 bg-white rounded shadow">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold text-red-700">Digite o CPF ou CNPJ:</label>
            <input type="text" name="cpf_cnpj" class="form-control" placeholder="Ex: 12345678900" required>
        </div>

        <button type="submit" class="btn btn-danger w-100">Buscar Cliente</button>
    </form>
</div>
</body>
</html>
