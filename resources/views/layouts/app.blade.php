<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insetário Virtual</title>
    @vite('resources/css/app.css')
</head>

<body>
    @php
    $links = [
    ['name' => 'Home', 'link' => '/'],
    ['name' => 'Insetário', 'link' => '/insectary'],
    ];
    @endphp

    <x-header :links="$links" />

    @yield('content')
    @yield('js')
    @vite(['resources/js/app.js'])

    @php
    $links = [
    ['name' => 'Home', 'link' => '/'],
    ['name' => 'Insetário', 'link' => '/insectary']
    ];
    @endphp

    <x-footer :links="$links" />

</body>

</html>