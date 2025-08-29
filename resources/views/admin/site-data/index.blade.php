@extends('layouts.admin-layout')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Informações do Site</h2>
        <a href="{{ route('admin.site-data.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Adicionar Informações</a>
    </div>

    <table class="w-full mt-6 border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siteContents as $data)
            <tr>
                <td class="border px-4 py-2">{{ $data->title }}</td>
                <td class="border px-4 py-2">{{ $data->description }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.site-data.edit', $data) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                    <form action="{{ route('admin.site-data.destroy', $data) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection