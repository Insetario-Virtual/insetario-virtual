<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Header --}}
    <header class="bg-[#22371c] text-white p-4 flex justify-between items-center shadow-md">
        <h1 class="text-xl font-bold">Painel Administrativo</h1>
        <div>
            <!-- <span class="mr-4">{{ Auth::user()->name }}</span> -->
            <form action="{{ route('admin.logout') }}" method="GET" class="inline">
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded font-semibold transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </header>

    {{-- Conteúdo principal --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</body>

</html>