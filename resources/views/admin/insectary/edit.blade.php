@extends('layouts.admin-layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold mb-4">Editar Inseto</h1>
        <a href="{{ route('admin.insectary.index') }}"
            class="px-4 py-2 rounded-xl text-white bg-[#445a1b] hover:opacity-90">
            Voltar
        </a>
    </div>
    <form action="{{ route('admin.insectary.update', $insect->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Scientific Name -->
        <div class="mb-4">
            <label for="scientific_name" class="block font-medium">Nome Científico:</label>
            <input type="text" name="scientific_name" id="scientific_name"
                value="{{ old('scientific_name', $insect->scientific_name) }}"
                class="w-full border rounded px-3 py-2">
            @error('scientific_name') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Order -->
        <div class="mb-4">
            <label for="order_id" class="block font-medium">Ordem:</label>
            <select name="order_id" id="order_id" class="w-full border rounded px-3 py-2">
                @foreach($orders as $order)
                <option value="{{ $order->id }}"
                    {{ old('order_id', $insect->order_id) == $order->id ? 'selected' : '' }}>
                    {{ $order->name }}
                </option>
                @endforeach
            </select>
            @error('order_id') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Family -->
        <div class="mb-4">
            <label for="family_id" class="block font-medium">Família:</label>
            <select name="family_id" id="family_id" class="w-full border rounded px-3 py-2">
                @foreach($families as $family)
                <option value="{{ $family->id }}"
                    {{ old('family_id', $insect->family_id) == $family->id ? 'selected' : '' }}>
                    {{ $family->name }}
                </option>
                @endforeach
            </select>
            @error('family_id') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Predator -->
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="predator" value="1"
                    {{ old('predator', $insect->predator) ? 'checked' : '' }}>
                <span class="ml-2">Predador</span>
            </label>
        </div>

        <!-- Importance -->
        <div class="mb-4">
            <label for="importance" class="block font-medium">Importância:</label>
            <textarea name="importance" id="importance" class="w-full border rounded px-3 py-2">{{ old('importance', $insect->importance) }}</textarea>
        </div>

        <!-- Morphology -->
        <div class="mb-4">
            <label for="morphology" class="block font-medium">Morfologia:</label>
            <textarea name="morphology" id="morphology" class="w-full border rounded px-3 py-2">{{ old('morphology', $insect->morphology) }}</textarea>
        </div>

        <!-- Common Names -->
        <div class="mb-4">
            <label class="block font-medium">Nomes Comuns:</label>
            <div id="commonNamesWrapper">
                @php
                $commonNames = old('common_names', $insect->commonNames->pluck('name')->toArray());
                @endphp
                @foreach($commonNames as $name)
                <div class="flex items-center gap-2 mb-2">
                    <input type="text" name="common_names[]" value="{{ $name }}"
                        class="w-full border rounded px-3 py-2">
                    <button type="button"
                        class="bg-red-500 text-white px-2 py-1 rounded"
                        onclick="this.parentElement.remove()">✕</button>
                </div>
                @endforeach
            </div>
            <button type="button" id="addCommonName"
                class="bg-blue-600 text-white px-3 py-1 rounded">+ Adicionar Novo Nome Comum</button>
        </div>

        <!-- Cultures -->
        <div id="cultureWrapper" class="mb-4">
            <label class="block font-medium">Culturas:</label>

            @php
            $selectedCultures = old('cultures', $insect->cultures->pluck('id')->toArray());
            @endphp

            @foreach($selectedCultures as $selected)
            <div class="flex items-center gap-2 mb-2">
                <select name="cultures[]" class="w-full border rounded px-3 py-2">
                    @foreach($cultures as $culture)
                    <option value="{{ $culture->id }}" {{ $selected == $culture->id ? 'selected' : '' }}>
                        {{ $culture->name }}
                    </option>
                    @endforeach
                </select>
                <button type="button" class="bg-red-500 text-white px-2 py-1 rounded" onclick="this.parentElement.remove()">✕</button>
            </div>
            @endforeach

            <button type="button" id="addCulture" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
                + Adicionar Cultura
            </button>
        </div>

        <!-- Images -->
        <div class="mb-4">
            <label class="block font-medium">Imagens:</label>
            <div class="mb-2">
                @foreach($insect->images as $img)
                <img src="{{ asset('storage/'.$img->path) }}" alt="Insect image" class="w-24 h-24 object-cover inline-block mr-2">
                @endforeach
            </div>
            <div id="imagesWrapper">
                <div class="flex items-center gap-2 mb-2">
                    <input type="file" name="images[]" class="w-full border rounded px-3 py-2">
                </div>
            </div>
            <button type="button" id="addImage"
                class="bg-blue-600 text-white px-3 py-1 rounded">+ Adicionar Nova Imagem</button>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Editar Inseto</button>
    </form>
</div>

<script>
    function createInputField(type, name) {
        const wrapper = document.createElement('div');
        wrapper.className = 'flex items-center gap-2 mb-2';

        const input = document.createElement('input');
        input.type = type;
        input.name = name;
        input.className = 'w-full border rounded px-3 py-2';

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.textContent = '✕';
        btn.className = 'bg-red-500 text-white px-2 py-1 rounded';
        btn.addEventListener('click', () => wrapper.remove());

        wrapper.appendChild(input);
        wrapper.appendChild(btn);

        return wrapper;
    }

    const cultures = @json($cultures);

    function createSelectField(name) {
        const wrapper = document.createElement('div');
        wrapper.className = 'flex items-center gap-2 mb-2';

        const select = document.createElement('select');
        select.name = name;
        select.className = 'w-full border rounded px-3 py-2';

        cultures.forEach(culture => {
            const option = document.createElement('option');
            option.value = culture.id;
            option.textContent = culture.name;
            select.appendChild(option);
        });

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.textContent = '✕';
        btn.className = 'bg-red-500 text-white px-2 py-1 rounded';
        btn.addEventListener('click', () => wrapper.remove());

        wrapper.appendChild(select);
        wrapper.appendChild(btn);

        return wrapper;
    }

    // Add Common Name
    document.getElementById('addCommonName').addEventListener('click', function() {
        const wrapper = document.getElementById('commonNamesWrapper');
        wrapper.appendChild(createInputField('text', 'common_names[]'));
    });

    // Add Culture
    document.getElementById('addCulture').addEventListener('click', function() {
        const wrapper = document.getElementById('cultureWrapper');
        wrapper.insertBefore(createSelectField('cultures[]'), this); // insere antes do botão
    });

    // Add Image
    document.getElementById('addImage').addEventListener('click', function() {
        const wrapper = document.getElementById('imagesWrapper');
        wrapper.appendChild(createInputField('file', 'images[]'));
    });
</script>
@endsection