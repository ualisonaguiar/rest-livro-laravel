<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Bem-vindo ao Sistema</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
            color: #333333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            color: #4CAF50;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        .credentials {
            background-color: #f1f1f1;
            border-left: 4px solid #4CAF50;
            padding: 10px;
            margin: 15px 0;
            font-family: monospace;
        }

        strong {
            display: block;
            margin-top: 20px;
            color: #d32f2f;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Olá, {{ $usuario->getNome() }}!</h1>
        <p>Seja muito bem-vindo ao nosso sistema 🚀</p>

        <p>Segue seus dados de acesso:</p>
        <div class="credentials">
            <p><strong>Login:</strong> {{ $usuario->getEmail() }}</p>
            <p><strong>Senha:</strong> {{ $senha }}</p>
        </div>

        <strong>Por questão de segurança, por favor altere sua senha após o primeiro acesso.</strong>
    </div>
</body>

</html>