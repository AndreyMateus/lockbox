<!DOCTYPE html>
<html lang="pt-br" data-theme="dim">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lockbox</title>
    <link rel="stylesheet" href="app.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4" defer></script>
</head>

<body class="flex flex-col sm:flex-col md:flex-col lg:flex-row h-screen overflow-auto">
    <?php include(convert_separator_of_path(base_path("/App/Views/partials/__navbar.view.php"))); ?>
    <?php include($viewName); ?>
</body>

</html>