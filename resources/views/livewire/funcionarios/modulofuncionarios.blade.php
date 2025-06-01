<section class="h-screen w-screen bg-blue-100 overflow-x-hidden">
    <div wire:loading wire:target='gerarRelatorioPDF'
        class="fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center">
        <div class="h-full w-full grid place-items-center">
            <div>
                <div class="relative w-20 h-20 mb-4 mx-auto">
                    <svg class="animate-spin w-full h-full text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <div class="absolute inset-0 grid place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-white font-medium animate-pulse">Gerando relatório PDF...</p>
            </div>
        </div>
    </div>
    <button wire:click="gerarRelatorioPDF"
        class="fixed bottom-6 right-20 bg-indigo-600 hover:bg-indigo-800 text-white p-4 rounded-full shadow-lg z-50 transition ">
        <i class="fa-solid fa-file-pdf fa-lg"></i>
    </button>
    <div x-data="{ showChart: false }">
        <button @click="showChart = !showChart"
            class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-800 text-white p-4 rounded-full shadow-lg z-50 transition">
            <i class="fa-solid fa-chart-column fa-lg"></i>
        </button>

        <div x-show="showChart" x-transition
            class="fixed inset-0 bg-black bg-opacity-40 z-40 flex items-center justify-center backdrop-blur-sm">
            <div @click.away="showChart = false"
                class="bg-white p-6 rounded-3xl shadow-xl w-full max-w-4xl h-96 relative">
                <button @click="showChart = false"
                    class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition">
                    <i class="fa-solid fa-xmark fa-xl"></i>
                </button>


                <!-- Gráfico -->
                <div
                    class="hidden md:block h-full  row-span-2 2xl:row-span-1  shadow-md bg-white rounded-3xl p-2 2xl:p-4 overflow-auto">
                    <div class="relative h-full">
                        <canvas id="myChart" style="width: 100%; height: 100%;"></canvas>
                    </div>

                    <script>
                        const ctx = document.getElementById('myChart').getContext('2d');

                        const labels = @json($funcionarios_pedidos->pluck('name'));
                        const pedidos = @json($funcionarios_pedidos->pluck('order_count'));
                        const concluidos = @json($funcionarios_pedidos->pluck('completed_orders_count'));

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                        label: 'Pedidos',
                                        data: pedidos,
                                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Pedidos Concluídos',
                                        data: concluidos,
                                        backgroundColor: 'rgba(75, 192, 75, 0.5)',
                                        borderColor: 'rgba(75, 192, 75, 1)',
                                        borderWidth: 1
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>


    <livewire:components.header.header />

    <div class="grid grid-rows-[auto_1fr] h-[calc(100vh-4rem)] max-w-7xl mx-auto gap-4 pt-4 pb-4 2xl:pb-16 px-8 ">
        <!-- Primeira linha -->
        <div class="grid gap-2 2xl:gap-4 h-full px-2">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <!-- Campo de pesquisa -->
                <div class="relative">
                    <form wire:submit.prevent="buscar">
                        <input type="text" wire:model.live.debounce.200="nomeFuncionario" placeholder="Pesquisar"
                            class="w-full px-4 py-2 bg-white border-b border-gray-400 focus:outline-none focus:border-blue-500 transition-all text-sm text-gray-800 placeholder-gray-500 lg:min-w-64">
                        <button type="submit"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <!-- Botoes de interacao -->
                <div>
                    <div class="flex items-center gap-2">
                        <!-- Botão Adicionar -->
                        <button type="button" wire:click='abrirModal'
                            class="p-2 bg-[#2096f2] text-[#f5f5f5] hover:bg-blue-500 transition-all shadow-md">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <!-- Paginação -->
                        <button wire:click="previousPage" class="p-2 bg-gray-300 hover:bg-gray-400 transition">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <button wire:click="nextPage"
                            class="p-2 bg-gray-300 hover:bg-gray-400 transition
                            @if ($funcionarios->currentPage() === $lastPage) opacity-50 cursor-not-allowed @endif"
                            @if ($funcionarios->currentPage() === $lastPage) disabled @endif>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                    {{-- <p class="ml-auto text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-md shadow-sm mt-4">
                        <i class="fa-solid fa-file-lines mr-1 text-blue-500"></i>
                        Página <span class="font-semibold">{{ $funcionarios->currentPage() }}</span> de <span
                            class="font-semibold">{{ $lastPage }}</span>
                    </p> --}}
                </div>

            </div>
            @if ($show == true)
                <!-- Modal de Cadastro -->
                <div class="h-screen w-screen z-50 fixed grid place-items-center left-0 top-0"
                    style="background-color:rgba(0,0,0,0.6)">
                    <form wire:submit.prevent='CadastrarFuncionario'
                        class="w-full max-w-xl bg-white rounded-lg shadow-md p-6 space-y-4 relative">
                        <div class="absolute top-3 right-3">
                            <button type="button" wire:click='fecharModal'
                                class="text-red-600 hover:text-red-800 transition-all duration-200 ease-in-out">
                                <i class="fa-solid fa-xmark fa-lg"></i>
                            </button>
                        </div>
                        <p class="text-center font-bold text-2xl text-gray-700 mb-4">Adicionar Funcionário</p>

                        <!-- Nome -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Nome</label>
                            <input type="text" wire:model="nome" placeholder="Digite o nome completo"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('nome')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Data de Nascimento -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Data de Nascimento</label>
                            <input type="date" wire:model="data_nascimento"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('data_nascimento')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">E-mail</label>
                            <input type="email" autocomplete="new-email" placeholder="exemplo@dominio.com"
                                wire:model="email"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('email')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Senha -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Senha</label>
                            <input type="password" autocomplete="new-password" placeholder="Digite uma senha segura"
                                wire:model="password"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('password')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Confirme a Senha</label>
                            <input type="password" autocomplete="new-password" placeholder="Digite a senha novamente"
                                wire:model="password_confirmation"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('password_confirmation')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Telefone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Telefone</label>
                            <input type="tel" placeholder="(99) 99999-9999" wire:model="telefone"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('telefone')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Cargo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Cargo</label>
                            <input type="text" placeholder="Ex: Atendente, Veterinário" wire:model="cargo"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('cargo')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Foto -->
                        <div>
                            <label for="imagem" class="block text-sm font-medium text-gray-600 mb-1">Imagem</label>
                            <input type="file" wire:model="photo_path"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('photo_path')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                            <div wire:loading wire:target='photo_path' class="flex items-center space-x-2 mt-2">
                                <!-- Spinner -->
                                <svg class="animate-spin h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                                </svg>

                                <!-- Texto -->
                                <span class="text-green-600 font-medium text-sm">Carregando imagem...</span>
                            </div>
                        </div>

                        <!-- Botão -->
                        <div class="pt-4">
                            <button
                                class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                                @if ($funcionarioId)
                                    Atualizar
                                @else
                                    Cadastrar
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- Mensagens de Sessão -->
            @if (session()->has('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                    {{ session('error') }}
                </div>
            @endif
        </div>




        <!-- Lista de funcionários -->
        <div
            class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 md:max-h-[500px] 2xl:max-h-fit overflow-y-auto px-2 ">
            @foreach ($funcionarios as $item)
                <div wire:key='item-{{ $item->id }}'
                    class="grid gap-4 bg-white shadow-lg rounded-xl px-4 py-2 relative max-h-80 ">
                    <div class="flex justify-between">

                        @if ($item->active == 1)
                            <div
                                class="flex items-center gap-2 px-3 py-1 rounded-full bg-gradient-to-r from-green-500 to-emerald-600 shadow-sm text-white text-xs font-medium">
                                Ativo
                            </div>
                        @else
                            <div x-data="{ showModal: false }" class="relative">
                                <button @click="showModal = true"
                                    class="flex items-center gap-2 px-3 py-1 rounded-full bg-gradient-to-r from-red-500 to-red-600 shadow-sm text-white text-xs font-medium transition duration-200 hover:brightness-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Desligado
                                </button>

                                <!-- Modal de confirmação -->
                                <div x-show="showModal" x-transition
                                    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
                                    <div @click.away="showModal = false"
                                        class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
                                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Confirmar Ação</h2>
                                        <p class="text-gray-600 mb-6">Deseja realmente alterar o status deste
                                            funcionário?</p>

                                        <div class="flex justify-end gap-3">
                                            <button @click="showModal = false"
                                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                                                Cancelar
                                            </button>
                                            <button
                                                @click="$wire.toggleStatus({{ $item->id }}); showModal = false"
                                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                                Confirmar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="relative">
                            <button type="button" wire:click='abrirModalOpcoes({{ $item['id'] }})'
                                class="cursor-pointer">
                                <i class="fa-solid fa-ellipsis text-gray-600 hover:text-gray-800 transition"></i>
                            </button>

                            @if ($modalAbertoParaId == $item['id'])
                                <div
                                    class="absolute top-0 right-0 w-48 bg-white shadow-lg rounded-lg border border-gray-200 z-30 py-4">
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click='abrirModalOpcoes({{ $item['id'] }})'
                                            class="text-gray-400 hover:text-gray-600">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>

                                    <div class="flex flex-col px-4 gap-2">
                                        <button type="button" wire:click='editarFuncionario({{ $item['id'] }})'
                                            class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 transition">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Editar
                                        </button>
                                        <button type="button" wire:click='confirmarExclusao({{ $item['id'] }})'
                                            class="flex items-center gap-2 text-sm text-red-600 hover:text-red-800 transition">
                                            <i class="fa-solid fa-trash"></i>
                                            Excluir
                                        </button>
                                    </div>
                                </div>
                            @endif

                            @if ($confirmando === $item['id'])
                                <div
                                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                    <div class="bg-white rounded-lg p-6 shadow-xl">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Tem certeza?</h2>
                                        <p class="text-sm text-gray-600 mb-6">Essa ação não poderá ser desfeita.</p>
                                        <div class="flex justify-end gap-4">
                                            <button wire:click='confirmarExclusao({{ $item['id'] }})'
                                                class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</button>
                                            <button wire:click='excluirFuncionario({{ $item['id'] }})'
                                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                Confirmar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Nome e cargo do funcionario --}}
                    <div class="flex flex-col items-center">
                        <div class="grid place-items-center mb-3">
                            @php
                                $path = $item['photo_path'];
                                $imgSrc = Str::startsWith($path, 'funcionarios/')
                                    ? asset('storage/' . $path)
                                    : asset('img/funcionarios/' . basename($path));
                            @endphp
                            <img src="{{ $imgSrc }}" alt="Foto de {{ $item['name'] }}"
                                class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md hover:border-emerald-200 transition-all duration-300">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $item['name'] }}</h3>
                        <p class="text-sm text-emerald-600 font-medium">{{ $item['role'] }}</p>
                    </div>

                    {{-- Informações de contato --}}
                    <div class="mt-2 text-xs w-full bg-gray-50 p-3 rounded-lg border border-gray-200">
                        <ul class="space-y-2">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-envelope text-gray-400 mt-0.5"></i>
                                <span class="text-gray-700 truncate max-w-44">{{ $item->email }}</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-phone text-gray-400 mt-0.5"></i>
                                @if (strlen($item->phone) === 11)
                                    <span class="text-gray-700 truncate max-w-44">
                                        ({{ substr($item->phone, 0, 2) }})
                                        {{ substr($item->phone, 2, 5) }}-{{ substr($item->phone, 7) }}
                                    </span>
                                @else
                                    <span class="text-gray-700 truncate max-w-44">{{ $item->phone }}</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginação -->
        {{-- <div class="max-w-6xl mx-auto py-4">
            <div class="grid gap-4">
                {{ $funcionarios->links() }}
            </div>
        </div> --}}
    </div>
</section>
