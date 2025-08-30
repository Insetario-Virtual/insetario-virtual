@extends('layouts.admin-layout')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-[#22371c]">Adicionar uma nova Ordem</h2>

    <form action="{{ route('admin.orders.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-[#445a1b] font-semibold">Nome da ordem:</label>
            <input type="text" name="name" class="w-full border rounded p-2 focus:ring-2 focus:ring-[#445a1b]" required>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="px-5 py-3 rounded-xl text-white bg-[#22371c] hover:bg-[#445a1b]">
                Salvar
            </button>
            <a href="{{ route('admin.orders.index') }}"
               class="px-5 py-3 rounded-xl border border-[#445a1b] text-[#445a1b] hover:bg-[#445a1b] hover:text-white">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection