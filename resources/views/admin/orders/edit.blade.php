@extends('layouts.admin-layout')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-[#22371c]">Editar Ordem</h2>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-[#445a1b] font-semibold">Novo nome da Ordem:</label>
            <input type="text" name="name" value="{{ $order->name }}" class="w-full border rounded p-2 focus:ring-2 focus:ring-[#445a1b]" required>
        </div>

        <button type="submit" class="px-4 py-2 rounded-xl text-white bg-[#22371c] hover:bg-[#445a1b]">
            Alterar
        </button>
    </form>
</div>
@endsection