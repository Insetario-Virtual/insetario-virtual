@extends('layouts.admin-layout')

@section('content')
<div class="p-6 max-w-xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold mb-4">Adicionar Novo Tópico:</h1>
        <a href="{{ route('admin.site-data.index') }}"
            class="px-4 py-2 rounded-xl text-white bg-[#445a1b] hover:opacity-90">
            Voltar
        </a>
    </div>
    <form method="POST" action="{{ route('admin.site-data.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Título:</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block font-medium">Descrição:</label>
            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <button class="bg-[#445a1b] hover:bg-[#2b3910] text-white px-4 py-2 rounded">Salvar</button>
    </form>
</div>
@endsection