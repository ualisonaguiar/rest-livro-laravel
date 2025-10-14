<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Compra Cancelada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #f5c2c7;
            border-radius: 8px;
            background-color: #f8d7da;
        }

        h1 {
            color: #d9534f;
        }

        .section {
            margin-top: 20px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .order-details,
        .delivery-details {
            border: 1px solid #f5c2c7;
            padding: 10px;
            border-radius: 5px;
            background-color: #fdf0f1;
        }

        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Compra Cancelada</h1>

        <p>Olá {{ $venda->usuario->ds_nome }},</p>

        <p>Lamentamos informar que sua compra foi <strong>cancelada</strong>. Abaixo estão os detalhes do pedido:</p>

        <div class="section order-details">
            <div class="section-title">Livro:</div>
            <p>{{ $venda->livro->no_nome }}<br>
                Autor: {{ $venda->livro->no_autor }}</p>

            <div class="section-title">Número do Pedido:</div>
            <p>#{{ $venda->id }}</p>

            <div class="section-title">Quantidade:</div>
            <p>{{ $venda->nu_quantidade }}</p>

            <div class="section-title">Total Estimado:</div>
            <p>R$ {{ number_format($venda->nu_preco * $venda->nu_quantidade, 2, ',', '.') }}</p>
        </div>

        <p>
            Caso o pagamento já tenha sido realizado, o estorno será processado automaticamente e poderá levar alguns dias úteis para aparecer na sua conta.
        </p>

        <p class="footer">
            Pedimos desculpas pelo transtorno.<br>
            Em caso de dúvidas, entre em contato com nossa equipe de suporte.<br><br>
            <strong>Equipe de Vendas</strong>
        </p>
    </div>
</body>

</html>
