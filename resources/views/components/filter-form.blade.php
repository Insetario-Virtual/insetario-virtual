<div class="form-container bg-black/[.25] w-full h-fit rounded px-4 py-3 mt-20 backdrop-blur-md z-10 text-white">
    <h1 class="text-xl sm:text-2xl font-semibold">Filtragem</h1>

    <form method="GET" action="{{ route('insectary.index') }}" id="filterForm" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
        @csrf

        <!-- Nome Comum -->
        <div class="flex gap-2 items-center">
            <label for="common_name" class="font-semibold text-nowrap">Nome Comum:</label>
            <input type="text" id="common_name" name="common_name"
                value="{{ request('common_name') }}"
                class="w-full bg-transparent border-b-2 border-white outline-none" />
        </div>

        <!-- Nome Científico -->
        <div class="flex gap-2 items-center">
            <label for="scientific_name" class="font-semibold text-nowrap">Nome Científico:</label>
            <input type="text" id="scientific_name" name="scientific_name"
                value="{{ request('scientific_name') }}"
                class="w-full bg-transparent border-b-2 border-white outline-none" />
        </div>

        <!-- Ordens -->
        <div class="flex gap-2 items-center">
            <label for="order" class="font-semibold text-nowrap">Ordem:</label>
            <select id="order" name="order"
                class="w-full bg-white/25 border-b-2 border-white outline-none">
                <option value="">Todas</option>
                @foreach($orders as $order)
                <option value="{{ $order->id }}" {{ request('order') == $order->id ? 'selected' : '' }}>
                    {{ $order->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Famílias -->
        <div class="flex gap-2 items-center">
            <label for="family" class="font-semibold">Família:</label>
            <select id="family" name="family"
                class="w-full bg-white/25 border-b-2 border-white outline-none">
                <option value="">Todas</option>
                @foreach($families as $family)
                <option value="{{ $family->id }}" {{ request('family') == $family->id ? 'selected' : '' }}>
                    {{ $family->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Predador -->
        <div class="flex items-center">
            <label for="predator" class="font-semibold">Predador:</label>
            <input type="checkbox" id="predator" name="predator" value="1" {{ request('predator') ? 'checked' : '' }} class="ml-3" />
        </div>

        <!-- Culturas -->
        <div class="flex gap-2 items-center">
            <label for="culture" class="font-semibold text-nowrap">Cultura atacada:</label>
            <select id="culture" name="culture"
                class="w-full bg-white/25 border-b-2 border-white outline-none">
                <option value="">Todas</option>
                @foreach($cultures as $culture)
                <option value="{{ $culture->id }}" {{ request('culture') == $culture->id ? 'selected' : '' }}>
                    {{ $culture->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Botões -->
        <div class="flex items-center justify-between col-span-full mt-4 max-sm:mt-12">
            <button type="button" id="resetBtn"
                class="ml-2 px-4 py-2 font-semibold bg-white/45 text-white rounded duration-200 ease-in-out hover:bg-white/25">
                Limpar
            </button>
            <button type="submit"
                class="px-4 py-2 font-semibold bg-green-600 text-white rounded duration-200 ease-in-out hover:bg-[#688A41]">
                Pesquisar
            </button>
        </div>
    </form>
</div>