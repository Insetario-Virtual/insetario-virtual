@extends('layouts.admin-layout')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Membros</h2>
    <a href="{{ route('admin.members.create') }}"
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Adicionar Membro</a>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded-lg shadow">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 text-left">ID</th>
                <th class="py-2 px-4 text-left">Nome</th>
                <th class="py-2 px-4 text-left">Função</th>
                <th class="py-2 px-4 text-left">Ativo</th>
                <th class="py-2 px-4 text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr class="border-b">
                <td class="py-2 px-4">{{ $member->id }}</td>
                <td class="py-2 px-4">{{ $member->name }}</td>
                <td class="py-2 px-4">{{ $member->role }}</td>
                <td class="py-2 px-4">{{ $member->active ? 'Sim' : 'Não' }}</td>
                <td class="py-2 px-4 text-center space-x-2">
                    <a href="{{ route('admin.members.edit', $member->id) }}"
                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">Editar</a>
                    <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                                onclick="return confirm('Deseja realmente excluir?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection