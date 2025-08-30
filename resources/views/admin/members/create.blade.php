@extends('layouts.admin-layout')

@section('title', 'Add Member')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-[#22371c] mb-4">Adicionar Membro</h2>
        <a href="{{ route('admin.members.index') }}"
            class="px-4 py-2 rounded-xl text-white bg-[#445a1b] hover:opacity-90">
            Voltar
        </a>
    </div>
    <form action="{{ route('admin.members.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Nome:</label>
            <input type="text" name="name" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Área:</label>
            <input type="text" name="role" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Status:</label>
            <select name="is_active" class="w-full border p-2 rounded-md">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
        </div>

        <button type="submit" class="bg-[#445a1b] text-white px-4 py-2 rounded-md">Salvar</button>
    </form>
</div>
@endsection