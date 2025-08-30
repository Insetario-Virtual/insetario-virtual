@extends('layouts.admin-layout')

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-[#22371c]">Adicionar Cultura</h1>

    <form action="{{ route('admin.cultures.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Nome:</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="submit" class="bg-[#445a1b] text-white px-4 py-2 rounded hover:bg-[#22371c]">
            Salvar
        </button>
        <a href="{{ route('admin.cultures.index') }}" class="ml-2 text-gray-600 hover:underline">Cancelar</a>
    </form>
</div>
@endsection