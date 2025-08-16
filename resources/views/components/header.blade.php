<header class="fixed top-0 left-0 w-full h-16 shadow-md z-30 bg-white" x-data="{ open: false }">
    <div class="flex items-center justify-between h-full px-10 max-sm:p-4">

        <a href="#">
            <div class="flex items-center gap-2 font-bold text-xl md:text-2xl cursor-pointer">
                <img src="{{ asset('insetario.png') }}" alt="Logo do Insetário Virtual" class="h-11 sm:h-12 rounded-full" />
                <span>Insetário Virtual</span>
            </div>
        </a>

        <div class="flex gap-7 md:gap-20">

            <nav :class="`absolute sm:static top-14 sm:top-0 right-0 w-fit sm:w-auto sm:flex items-center bg-white sm:bg-transparent transition-all duration-500 ease-in-out overflow-hidden ${open ? 'max-h-[300px] opacity-100 shadow-lg' : 'max-h-0 opacity-0'} sm:max-h-none sm:opacity-100`">
                <ul class="flex flex-col gap-10 p-4 sm:flex-row sm:items-center w-fit sm:w-auto">
                    @foreach ($links as $link)
                        <li class="font-semibold text-lg">
                            <a href="{{ $link['link'] }}" class="text-gray-800 hover:text-[#688A41] transition duration-150" @click="open = false">
                                {{ $link['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="hidden sm:flex items-center gap-4">
                <img src="{{ asset('icons/if.png') }}" alt="Logo do IFRS" class="h-11 transition duration-500" :class="{ 'hidden': open, 'block': !open }" />
            </div>
        </div>

        <button @click="open = !open" class="sm:hidden flex items-center px-2 py-1 rounded-sm transition duration-100 hover:bg-slate-200" :class="{ 'z-50': open, 'z-20': !open }">
            <i x-show="open" class="pi pi-times" style="font-size: 1.4rem"></i>
            <i x-show="!open" class="pi pi-bars" style="font-size: 1.4rem"></i>
        </button>
    </div>
</header>