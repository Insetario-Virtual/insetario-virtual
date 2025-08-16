<footer class="w-full bg-white py-5">
    <div class="px-10 max-sm:px-4">
        <div class="flex flex-col md:flex-row md:justify-between gap-x-15 gap-y-8">
            <div class="flex flex-col md:w-2/5">
                <div class="flex items-center gap-4 mb-4">
                    <img src="{{ asset('assets/icons/insetario.png') }}" class="h-10 rounded-full" alt="Logo do Insetário Virtual" />
                    <span class="text-lg font-sans font-bold">Insetário Virtual</span>
                    <img src="{{ asset('assets/icons/if.png') }}" class="h-8" alt="Logo do IFRS" />
                </div>
                <p class="text-sm text-gray-600">
                    Projeto de extensão do IFRS-Campus Bento Gonçalves de um insetário virtual com intuito de
                    auxiliar alunos de cursos técnicos que envolvam agronomia e comunidade em geral na
                    identificação de insetos.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-6 md:grid-cols-3 sm:gap-6 md:w-9/12">
                <div class="pl-0 md:pl-6">
                    <h2 class="mb-4 text-sm font-semibold text-gray-900 uppercase">Navegação</h2>
                    <ul class="text-gray-600 space-y-2">
                        @foreach ($links as $link)
                            <li class="hover:underline">
                                <a href="{{ $link['link'] }}">
                                    {{ $link['name'] }}
                                </a>
                            </li>
                        @endforeach
                        <li class="hover:underline">
                            <a href="#">Referências</a>
                        </li>
                    </ul>
                </div>

                <div class="pl-0 md:pl-6">
                    <h2 class="mb-4 text-sm font-semibold text-gray-900 uppercase">Siga-nos</h2>
                    <ul class="text-gray-600 space-y-2">
                        <li><span>Instagram</span></li>
                        <li><span>GitHub</span></li>
                    </ul>
                </div>

                <div class="pl-0">
                    <h2 class="mb-4 text-sm font-semibold text-gray-900 uppercase">Contate-nos</h2>
                    <ul class="text-gray-600 space-y-2">
                        <li>
                            <a href="mailto:insetarioifrs@gmail.com" class="hover:underline">insetarioifrs@gmail.com</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <hr class="my-6 border-gray-200" />

        <div class="flex flex-col sm:flex-row justify-between items-center text-center sm:text-left">
            <span class="text-sm text-gray-500">
                © 2024 Insetário Virtual. Todos Direitos Reservados.
            </span>
        </div>
    </div>
</footer>
