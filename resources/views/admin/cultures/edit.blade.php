@extends('layouts.admin-layout')

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold mb-4 text-[#22371c]">Edit Culture</h1>
        <a href="{{ route('admin.cultures.index') }}"
            class="px-4 py-2 rounded-xl text-white bg-[#445a1b] hover:opacity-90">
            Voltar
        </a>
    </div>
    <form action="{{ route('admin.cultures.update', $culture->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nome Editado:</label>
            <input type="text" name="name" value="{{ $culture->name }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="submit" class="bg-[#445a1b] text-white px-4 py-2 rounded hover:bg-[#22371c]">
            Editar
        </button>
        <a href="{{ route('admin.cultures.index') }}" class="ml-2 text-gray-600 hover:underline">Cancelar</a>
    </form>
</div>
@endsection