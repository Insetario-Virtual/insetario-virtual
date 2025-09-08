@extends('layouts.admin-layout')

@section('title', 'Edit Member')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-[#22371c] mb-4">Editar Membro</h2>
        <a href="{{ route('admin.members.index') }}"
            class="px-4 py-2 rounded-xl text-white bg-[#445a1b] hover:opacity-90">
            Voltar
        </a>
    </div>
    <form action="{{ route('admin.members.update', $member->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Nome:</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $member->name) }}"
                class="w-full border p-2 rounded-md"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium">Área:</label>
            <input
                type="text"
                name="role"
                value="{{ old('role', $member->role) }}"
                class="w-full border p-2 rounded-md"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium">Ativo:</label>
            <select name="active" class="w-full border p-2 rounded-md" required>
                <option value="1" {{ old('active', $member->active) == 1 ? 'selected' : '' }}>Sim</option>
                <option value="0" {{ old('active', $member->active) == 0 ? 'selected' : '' }}>Não</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Imagem:</label>
            <div class="flex items-center gap-2 mb-2">
                <input type="file" name="image_path" class="w-full border rounded p-2">
            </div>
        </div>

        <button type="submit" class="bg-[#445a1b] text-white px-4 py-2 rounded-md">
            Atualizar
        </button>
    </form>
</div>
@endsection