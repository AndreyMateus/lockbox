<?php
$msg = $data['msg'];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background: rgb(35, 41, 43);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .error-container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 52px;
            color: #4da3ff;
            margin-bottom: 20px;
        }

        p {
            color: #c7c7c7;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        a {
            display: inline-block;
            padding: 14px 28px;
            background: #4da3ff;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: background .2s;
        }

        a:hover {
            background: #368ce8;
        }
    </style>
</head>

<body>

    <main class="error-container">

        <h1>Erro</h1>

        <p>
            <?= $msg ?>
        </p>

        <a href="/">Voltar</a>

    </main>

</body>

</html>