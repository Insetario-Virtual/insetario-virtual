<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Admin</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- Cabeçalho --}}
    <header class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-2xl font-bold">Dashboard do Admin</h1>
            <form method="GET" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded font-semibold transition">
                    Sair
                </button>
            </form>
        </div>
    </header>

    {{-- Conteúdo Principal --}}
    <main class="container mx-auto py-10 px-6">
        <h2 class="text-xl font-semibold mb-6">Bem-vindo!!</h2>

        {{-- Cards do Dashboard --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- CRUD de Insetos --}}
            <a href="{{ route('insectary.index') }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold mb-2">Gerenciar Insetos</h3>
                    <p class="text-gray-600">Adicionar, editar ou remover insetos e seus dados.</p>
                </div>
                <div class="mt-4 text-blue-600 font-semibold">Ir &rarr;</div>
            </a>

            {{-- CRUD de Ordens --}}
            <a href="{{ route('admin.orders.index') }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold mb-2">Gerenciar Ordens</h3>
                    <p class="text-gray-600">Editar ordens de insetos e dados relacionados.</p>
                </div>
                <div class="mt-4 text-blue-600 font-semibold">Ir &rarr;</div>
            </a>

            {{-- CRUD de Famílias --}}
            <a href="{{ route('admin.families.index') }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold mb-2">Gerenciar Famílias</h3>
                    <p class="text-gray-600">Editar famílias vinculadas às ordens.</p>
                </div>
                <div class="mt-4 text-blue-600 font-semibold">Ir &rarr;</div>
            </a>

            {{-- CRUD de Culturas --}}
            <a href="{{ route('admin.cultures.index') }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold mb-2">Gerenciar Culturas</h3>
                    <p class="text-gray-600">Gerenciar culturas afetadas pelos insetos.</p>
                </div>
                <div class="mt-4 text-blue-600 font-semibold">Ir &rarr;</div>
            </a>

            {{-- CRUD de Equipe --}}
            <a href="{{ route('admin.members.index') }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold mb-2">Gerenciar Equipe</h3>
                    <p class="text-gray-600">Gerenciar membros da equipe de admins ou editores.</p>
                </div>
                <div class="mt-4 text-blue-600 font-semibold">Ir &rarr;</div>
            </a>

            {{-- CRUD de Dados do Site --}}
            <a href="{{ route('admin.site-data.index') }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold mb-2">Configurações do Site</h3>
                    <p class="text-gray-600">Editar informações e conteúdos do site.</p>
                </div>
                <div class="mt-4 text-blue-600 font-semibold">Ir &rarr;</div>
            </a>
        </div>
    </main>

</body>
</html>