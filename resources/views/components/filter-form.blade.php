<div class="form-container bg-black/[.25] w-full h-fit rounded px-4 py-3 mt-4 backdrop-blur-md z-10 text-white"
    x-data="filterForm({{ json_encode($orders) }}, {{ json_encode($families) }}, {{ json_encode($cultures) }})">

    <h1 class="text-xl sm:text-2xl font-semibold">Filtragem</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
        <!-- Nome Comum -->
        <div class="flex gap-2 items-center">
            <label for="common_name" class="font-semibold text-nowrap">Nome Comum:</label>
            <input type="text" id="common_name" x-model="formData.common_name"
                class="w-full bg-transparent border-b-2 border-white outline-none" />
        </div>

        <!-- Nome Científico -->
        <div class="flex gap-2 items-center">
            <label for="scientific_name" class="font-semibold text-nowrap">Nome Científico:</label>
            <input type="text" id="scientific_name" x-model="formData.scientific_name"
                class="w-full bg-transparent border-b-2 border-white outline-none" />
        </div>

        <!-- Ordens -->
        <div class="flex gap-2 items-center">
            <label for="order" class="font-semibold text-nowrap">Ordem:</label>
            <select id="order" x-model="formData.order" @change="updateFamilias"
                class="w-full bg-white/25 border-b-2 border-white outline-none">
                <option value="">Todas</option>
                <template x-for="order in orders" :key="order.id">
                    <option :value="order.id" x-text="order.name"></option>
                </template>
            </select>
        </div>

        <!-- Famílias -->
        <div class="flex gap-2 items-center">
            <label for="family" class="font-semibold">Família:</label>
            <select id="family" x-model="formData.family"
                class="w-full bg-white/25 border-b-2 border-white outline-none">
                <option value="">Todas</option>
                <template x-for="family in filteredFamilias()" :key="family.id">
                    <option :value="family.id" x-text="family.name"></option>
                </template>
            </select>
        </div>

        <!-- Predador -->
        <div class="flex items-center">
            <label for="pretator" class="font-semibold">Predador:</label>
            <input type="checkbox" id="pretator" x-model="formData.pretator" @change="updatePretator" class="ml-3" />
        </div>

        <!-- Culturas -->
        <template x-if="!formData.pretator">
            <div class="flex gap-2 items-center">
                <label for="culture" class="font-semibold text-nowrap">Cultura atacada:</label>
                <select id="culture" x-model="formData.culture"
                    class="w-full bg-white/25 border-b-2 border-white outline-none">
                    <option value="">Todas</option>
                    <template x-for="culture in cultures" :key="culture.id">
                        <option :value="culture.id" x-text="culture.name"></option>
                    </template>
                </select>
            </div>
        </template>
    </div>

    <!-- Botões -->
    <div class="flex items-center justify-between mt-4 max-sm:mt-12">
        <button @click="handleReset"
            class="ml-2 px-4 py-2 font-semibold bg-white/45 text-white rounded duration-200 ease-in-out hover:bg-white/25">
            Limpar
        </button>
        <button @click="handleSearch"
            class="px-4 py-2 font-semibold bg-green-600 text-white rounded duration-200 ease-in-out hover:bg-[#688A41]">
            Pesquisar
        </button>
    </div>
</div>

<script>
    function filterForm(orders, families, culturas) {
        return {
            orders,
            families,
            cultures,
            currentOrder: '',
            formData: {
                common_name: '',
                scientific_name: '',
                order: '',
                family: '',
                pretator: false,
                culture: '',
            },

            filteredFamilias() {
                if (!this.formData.order) return this.families;
                return this.families.filter(f => f.id_order == this.formData.order);
            },

            updateFamilias() {
                if (this.formData.order !== this.currentOrder) {
                    this.formData.family = '';
                }
                this.currentOrder = this.formData.order;
            },

            updatePretator() {
                if (this.formData.pretator) {
                    this.formData.culture = '';
                }
            },

            handleReset() {
                this.formData = {
                    common_name: '',
                    scientific_name: '',
                    order: '',
                    family: '',
                    pretator: false,
                    culture: '',
                };
                this.handleSearch();
            },

            handleSearch() {
                console.log("🔎 Pesquisando com filtros:", this.formData);
            }
        }
    }
</script>