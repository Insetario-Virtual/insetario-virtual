@extends('layouts.admin-layout')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-xl shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold mb-4">Adicionar Inseto</h2>
        <a href="{{ route('admin.insectary.index') }}"
            class="px-4 py-2 rounded-xl text-white bg-[#445a1b] hover:opacity-90">
            Voltar
        </a>
    </div>
    <form method="POST" action="{{ route('admin.insectary.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Common Names -->
        <div class="mb-4">
            <label class="block font-semibold">Nomes Comuns:</label>
            <div id="commonNamesWrapper">
                <div class="flex items-center gap-2 mb-2">
                    <input type="text" name="common_names[]" class="w-full border rounded p-2">
                </div>
            </div>
            <button type="button" id="addCommonName" class="bg-blue-600 text-white px-3 py-1 rounded">Adicionar Novo Nome Comum</button>
        </div>

        <!-- Scientific Name -->
        <div class="mb-4">
            <label class="block font-semibold">Nome Científico:</label>
            <input type="text" name="scientific_name" class="w-full border rounded p-2" required>
        </div>

        <!-- Order + Family -->
        <div class="mb-4">
            <label class="block font-semibold">Ordem:</label>
            <select name="order_id" id="orderSelect" class="w-full border rounded p-2" required>
                <option value="">Selecione a Ordem</option>
                @foreach($orders as $order)
                <option value="{{ $order->id }}">{{ $order->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Família:</label>
            <select name="family_id" id="familySelect" class="w-full border rounded p-2" required>
                <option value="">Selecione a Família</option>
            </select>
        </div>

        <!-- Predator -->
        <div class="mb-4">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="predator" value="1">
                <span>É Predador?</span>
            </label>
        </div>

        <!-- Cultures -->
        <div class="mb-4">
            <label class="block font-semibold">Culturas:</label>
            <div id="culturesWrapper">
                <select name="cultures[]" id="cultures" class="w-full border rounded p-2">
                    <option value="" selected> Selecione uma Cultura</option>
                    @foreach($cultures as $culture)
                    <option value="{{ $culture->id }}">
                        {{ $culture->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="button" id="addCulture" class="bg-blue-600 text-white px-3 py-1 rounded">
                + Adicionar Cultura
            </button>
        </div>

        <!-- Importance -->
        <div class="mb-4">
            <label class="block font-semibold">Importância:</label>
            <textarea name="importance" class="w-full border rounded p-2"></textarea>
        </div>

        <!-- Morphology -->
        <div class="mb-4">
            <label class="block font-semibold">Morfologia:</label>
            <textarea name="morphology" class="w-full border rounded p-2"></textarea>
        </div>

        <!-- Images -->
        <div class="mb-4">
            <label class="block font-semibold">Imagens:</label>
            <div id="imagesWrapper">
                <div class="flex items-center gap-2 mb-2">
                    <input type="file" name="images[]" class="w-full border rounded p-2">
                </div>
            </div>
            <button type="button" id="addImage" class="bg-blue-600 text-white px-3 py-1 rounded">+ Adicionar Nova Imagem</button>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Adicionar Inseto</button>
    </form>
</div>

<script>
    function createInputField(type, name) {
        const wrapper = document.createElement('div');
        wrapper.className = 'flex items-center gap-2 mb-2';

        const input = document.createElement('input');
        input.type = type;
        input.name = name;
        input.className = 'w-full border rounded p-2';

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
        select.className = 'w-full border rounded p-2';

        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Selecione uma Cultura';
        select.appendChild(defaultOption);

        cultures.forEach(c => {
            const option = document.createElement('option');
            option.value = c.id;
            option.textContent = c.name;
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

    // Add new culture select
    document.getElementById('addCulture').addEventListener('click', function() {
        const wrapper = document.getElementById('culturesWrapper');
        wrapper.appendChild(createSelectField('cultures[]'));
    });

    // Add Common Name
    document.getElementById('addCommonName').addEventListener('click', function() {
        const wrapper = document.getElementById('commonNamesWrapper');
        wrapper.appendChild(createInputField('text', 'common_names[]'));
    });

    // Add Image
    document.getElementById('addImage').addEventListener('click', function() {
        const wrapper = document.getElementById('imagesWrapper');
        wrapper.appendChild(createInputField('file', 'images[]'));
    });

    // Relation -> Orders with Families
    const orders = @json($orders);

    document.getElementById('orderSelect').addEventListener('change', function() {
        const orderId = this.value;
        const familySelect = document.getElementById('familySelect');
        familySelect.innerHTML = '<option value="">Selecione a Família</option>';

        if (orderId) {
            const order = orders.find(o => o.id == orderId);
            if (order && order.families) {
                order.families.forEach(f => {
                    let option = document.createElement('option');
                    option.value = f.id;
                    option.textContent = f.name;
                    familySelect.appendChild(option);
                });
            }
        }
    });
</script>
@endsection