<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Vite CSS -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-zinc-950">

    <div class="min-h-screen flex flex-col items-center justify-start">
        <div class="text-center mt-[30vh] flex flex-col">
            <h1 class="text-4xl font-bold text-emerald-500">
                Bem-vindo ao EasyRes
            </h1>
            <button class="mt-4 font-[500] border border-emerald-600 text-zinc-100 rounded-lg py-2 px-6" onclick="window.location.href='/resume/all'"><i class="bi bi-file-earmark-person"> </i>Currículos cadastrados</button>
            <button class="mt-2 font-[500] border border-emerald-600 text-zinc-100 rounded-lg py-2 px-6" onclick="window.location.href='/resume/create'"><i class="bi bi-plus-circle"> </i>Cadastrar currículo</button>
        </div>
    </div>

</body>
</html>
