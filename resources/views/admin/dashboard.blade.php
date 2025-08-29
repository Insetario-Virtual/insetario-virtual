@extends('layouts.admin-layout')

@section('content')
<h2 class="text-xl font-semibold mb-6">Bem-vindo!!</h2>

{{-- Cards do Dashboard --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    {{-- CRUD de Insetos --}}
    <a href="{{ route('admin.insectary.index') }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition p-6 flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-bold mb-2">Gerenciar Insetos</h3>
            <p class="text-gray-600">Adicionar, editar ou remover insetos e seus dados.</p>
        </div>
        <div class="mt-4 text-[#445a1b] font-semibold">Ir &rarr;</div>
    </a>

    {{-- CRUD de Ordens --}}
    <a href="{{ route('admin.orders.index') }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition p-6 flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-bold mb-2">Gerenciar Ordens</h3>
            <p class="text-gray-600">Editar ordens de insetos e dados relacionados.</p>
        </div>
        <div class="mt-4 text-[#445a1b] font-semibold">Ir &rarr;</div>
    </a>

    {{-- CRUD de Famílias --}}
    <a href="{{ route('admin.families.index') }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition p-6 flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-bold mb-2">Gerenciar Famílias</h3>
            <p class="text-gray-600">Editar famílias vinculadas às ordens.</p>
        </div>
        <div class="mt-4 text-[#445a1b] font-semibold">Ir &rarr;</div>
    </a>

    {{-- CRUD de Culturas --}}
    <a href="{{ route('admin.cultures.index') }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition p-6 flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-bold mb-2">Gerenciar Culturas</h3>
            <p class="text-gray-600">Gerenciar culturas afetadas pelos insetos.</p>
        </div>
        <div class="mt-4 text-[#445a1b] font-semibold">Ir &rarr;</div>
    </a>

    {{-- CRUD de Equipe --}}
    <a href="{{ route('admin.members.index') }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition p-6 flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-bold mb-2">Gerenciar Equipe</h3>
            <p class="text-gray-600">Gerenciar membros da equipe de admins ou editores.</p>
        </div>
        <div class="mt-4 text-[#445a1b] font-semibold">Ir &rarr;</div>
    </a>

    {{-- CRUD de Dados do Site --}}
    <a href="{{ route('admin.site-data.index') }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:-translate-y-1 transition p-6 flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-bold mb-2">Configurações do Site</h3>
            <p class="text-gray-600">Editar informações e conteúdos do site.</p>
        </div>
        <div class="mt-4 text-[#445a1b] font-semibold">Ir &rarr;</div>
    </a>
</div>
@endsection