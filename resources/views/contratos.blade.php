<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contratos do Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="mb-4 text-center text-danger">Planos Ativos do Cliente</h1>

    <a href="{{ route('cliente.form') }}" class="btn btn-outline-danger mb-3">Voltar</a>

    @if(empty($contratos))
        <div class="alert alert-warning">Nenhum contrato ativo encontrado.</div>
    @else
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-danger">
                <tr>
                    <th>ID</th>
                    <th>Plano</th>
                    <th>Mensalidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contratos as $contrato)
                    <tr>
                        <td>{{ $contrato['id'] ?? '-' }}</td>
                        <td>{{ $contrato['contrato'] ?? '-' }}</td>
                        <td>R$ {{ $contrato['valor_mensal'] ?? '0,00' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>
