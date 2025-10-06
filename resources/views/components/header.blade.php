<header class="fixed top-0 left-0 w-full bg-[#21361b]/95 backdrop-blur-md shadow-md z-30 text-white">
    <div class="flex items-center justify-between h-16 px-6 sm:px-10 max-w-7xl mx-auto">

        <a href="/" class="flex items-center gap-2 font-semibold text-lg sm:text-xl">
            <img src="{{ asset('storage/icons/insetario.png') }}"
                alt="Logo do Insetário Virtual"
                class="h-10 w-10 rounded-full shadow-md">
            <span class="tracking-wide">Insetário Virtual</span>
        </a>

        <button id="menu-toggle" class="block md:hidden text-2xl focus:outline-none">
            ☰
        </button>

        <nav id="menu" class="hidden md:flex flex-col md:flex-row md:items-center absolute md:static top-16 left-0 w-full md:w-auto bg-[#1a2b16] md:bg-transparent shadow-lg md:shadow-none transition-all duration-300">
            <ul class="flex flex-col md:flex-row items-center md:gap-10 gap-6 py-6 md:py-0">
                @foreach ($links as $link)
                <li>
                    <a href="{{ $link['link'] }}"
                        class="text-white hover:text-[#9ad06b] font-medium text-lg sm:text-base transition-colors duration-200"
                        onclick="closeMenu()">
                        {{ $link['name'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </nav>

        <div class="hidden md:flex items-center">
            <img src="{{ asset('storage/icons/if.png') }}"
                alt="Logo do IFRS"
                class="h-10 opacity-90 hover:opacity-100 transition duration-300">
        </div>
    </div>
</header>

<script>
    const menuToggle = document.getElementById("menu-toggle");
    const menu = document.getElementById("menu");

    menuToggle.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });

    function closeMenu() {
        if (window.innerWidth < 768) {
            menu.classList.add("hidden");
        }
    }

    document.addEventListener("click", (e) => {
        if (window.innerWidth < 768 && !menu.contains(e.target) && !menuToggle.contains(e.target)) {
            menu.classList.add("hidden");
        }
    });
</script>