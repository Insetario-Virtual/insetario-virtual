@extends('layouts.admin-layout')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-md">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-[#22371c]">Nova Família</h2>
        <a href="{{ route('admin.families.index') }}"
           class="px-4 py-2 rounded-xl text-white bg-[#445a1b] hover:opacity-90">
            Voltar
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-3 text-red-700">
            <ul class="list-disc ml-5 text-sm">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.families.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-[#445a1b] font-semibold mb-1">Nome</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#445a1b] focus:outline-none"
                   required>
        </div>

        <div>
            <label class="block text-[#445a1b] font-semibold mb-1">Ordem</label>
            <select name="order_id"
                    class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#445a1b] focus:outline-none"
                    required>
                <option value="" disabled {{ old('order_id') ? '' : 'selected' }}>Selecione a ordem que pertence</option>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ old('order_id') == $order->id ? 'selected' : '' }}>
                        {{ $order->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="px-5 py-3 rounded-xl text-white bg-[#22371c] hover:bg-[#445a1b]">
                Salvar
            </button>
            <a href="{{ route('admin.families.index') }}"
               class="px-5 py-3 rounded-xl border border-[#445a1b] text-[#445a1b] hover:bg-[#445a1b] hover:text-white">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection