<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Compra Confirmada!</title>
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
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        h1 {
            color: #ff9900;
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
            border: 1px solid #eee;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
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
        <h1>Compra Confirmada!</h1>

        <p>Olá {{ $venda->usuario->ds_nome }},</p>

        <p>Sua compra foi confirmada com sucesso! Seguem os detalhes do seu pedido:</p>

        <div class="section order-details">
            <div class="section-title">Livro:</div>
            <p>{{ $venda->livro->no_nome }}<br>
                Autor: {{ $venda->livro->no_autor }}</p>

            <div class="section-title">Número do Pedido:</div>
            <p>#{{ $vendaEntrega->id }}</p>

            <div class="section-title">Quantidade:</div>
            <p>{{ $venda->nu_quantidade }}</p>

            <div class="section-title">Total:</div>
            <p>R$ {{ number_format($venda->nu_preco * $venda->nu_quantidade, 2, ',', '.') }}</p>
        </div>

        <div class="section delivery-details">
            <div class="section-title">Endereço de Entrega:</div>
            <p>
                {{ $vendaEntrega->ds_logradouro }}, {{ $vendaEntrega->ds_numero }}
                @if($vendaEntrega->ds_complemento)
                , {{ $vendaEntrega->ds_complemento }}
                @endif<br>
                Bairro: {{ $vendaEntrega->ds_bairro }}<br>
                CEP: {{ $vendaEntrega->nu_cep }}<br>
                {{ $vendaEntrega->ds_municipio }} - {{ $vendaEntrega->ds_estado }}
            </p>
        </div>

        <p class="footer">
            Obrigado por comprar conosco!<br>
            Equipe de Vendas
        </p>
    </div>
</body>

</html>
