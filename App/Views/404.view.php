<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página não encontrada</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: rgb(35, 41, 43);
            color: #ffffff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
            padding: 40px;
            max-width: 600px;
        }

        h1 {
            font-size: 120px;
            color: #4da3ff;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        p {
            color: #c7c7c7;
            line-height: 1.6;
            margin-bottom: 35px;
        }

        a {
            display: inline-block;
            text-decoration: none;
            background: #4da3ff;
            color: white;
            padding: 14px 28px;
            border-radius: 6px;
            font-size: 18px;
            transition: .25s;
        }

        a:hover {
            background: #2f86e5;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 80px;
            }

            h2 {
                font-size: 24px;
            }

            p {
                font-size: 15px;
            }

            a {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>404</h1>

        <h2>Página não encontrada</h2>

        <p>
            A página que você tentou acessar não existe ou foi removida.
            Verifique o endereço informado ou retorne para a página inicial.
        </p>

        <a href="/">Voltar para a página inicial</a>
    </div>

</body>

</html>