<footer class="w-full bg-[#21361b]/95 text-white py-8 mt-16 backdrop-blur-md shadow-inner">
    <div class="max-w-7xl mx-auto px-6 sm:px-10">
        <div class="flex flex-col md:flex-row md:justify-between gap-10">

            <div class="flex flex-col md:w-2/5">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('storage/icons/insetario.png') }}"
                        alt="Logo do Insetário Virtual"
                        class="h-10 w-10 rounded-full shadow-md">
                    <span class="text-lg font-semibold tracking-wide">Insetário Virtual</span>
                    <img src="{{ asset('storage/icons/if.png') }}"
                        alt="Logo do IFRS"
                        class="h-8 opacity-90">
                </div>
                <p class="text-sm text-gray-300 leading-relaxed">
                    Projeto de extensão do IFRS - Campus Bento Gonçalves, com o objetivo de auxiliar
                    estudantes e a comunidade na identificação de insetos de importância agrícola,
                    tornando o conhecimento acessível e digital.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-10 md:w-3/5">

                <div>
                    <h2 class="mb-3 text-sm font-semibold uppercase text-[#9ad06b] tracking-wider">Navegação</h2>
                    <ul class="space-y-2">
                        @foreach ($links as $link)
                        <li>
                            <a href="{{ $link['link'] }}"
                                class="text-gray-200 hover:text-[#9ad06b] transition-colors duration-200">
                                {{ $link['name'] }}
                            </a>
                        </li>
                        @endforeach
                        <li>
                            <a href="#" class="text-gray-200 hover:text-[#9ad06b] transition-colors duration-200">
                                Referências
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="mb-3 text-sm font-semibold uppercase text-[#9ad06b] tracking-wider">Siga-nos</h2>
                    <ul class="space-y-2">
                        <li>
                            <a href="https://www.instagram.com/insetario_ifrs_bg?igsh=MXJ3YTZrZWkxZ2s4aA==" target="_blank"
                                class="text-gray-200 hover:text-[#9ad06b] transition-colors duration-200">
                                Instagram
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/insetario_ifrs_bg?igsh=MXJ3YTZrZWkxZ2s4aA==" target="_blank"
                                class="text-gray-200 hover:text-[#9ad06b] transition-colors duration-200">
                                GitHub
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="mb-3 text-sm font-semibold uppercase text-[#9ad06b] tracking-wider">Contate-nos</h2>
                    <ul class="space-y-2">
                        <li>
                            <a href="mailto:insetarioifrs@gmail.com"
                                class="text-gray-200 hover:text-[#9ad06b] transition-colors duration-200">
                                insetarioifrs@gmail.com
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <hr class="my-6 border-gray-700/50">

        <div class="flex flex-col sm:flex-row justify-between items-center text-center sm:text-left text-gray-400 text-sm">
            <span>© {{ date('Y') }} Insetário Virtual. Todos os direitos reservados.</span>
            <span class="mt-2 sm:mt-0">Desenvolvido no IFRS - <i>Campus</i> Bento Gonçalves</span>
        </div>
    </div>
</footer>