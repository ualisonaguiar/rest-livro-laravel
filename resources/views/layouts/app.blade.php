<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Livro')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">

    {{-- Navbar --}}
    @include('layouts.partials.header')

    {{-- Conteúdo principal --}}
    <main class="container mx-auto bg-white  flex-1 p-6">
        <h2>@yield('title')</h2>
        @yield('content')
    </main>

    {{-- Rodapé --}}
    @include('layouts.partials.footer')
</body>

</html>
