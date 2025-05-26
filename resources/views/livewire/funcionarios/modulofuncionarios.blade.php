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
            class="fixed inset-0 bg-black bg-opacity-40 z-40 flex items-center justify-center">
            <div @click.away="showChart = false"
                class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-4xl h-96 relative">
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
    <div class="max-w-screen-xl mx-auto gap-4 mt-8 px-8 ">
        <div class=" grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 items-center ">

            <form class="relative w-full col-span-1" wire:submit.prevent="buscar">
                <input type="text" wire:model.live.debounce.100="nomeFuncionario" placeholder="Pesquisar"
                    class="w-full px-4 py-1 pr-10 rounded-lg border border-gray-300 focus:outline-none">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            {{-- Antiga paginação --}}
            {{-- <div class=" col-span-2 flex justify-center ">
                <button wire:click="previousPage" class="px-4 py-2 bg-gray-300 rounded-md mr-2">Anterior</button>
                <button wire:click="nextPage" class="px-4 py-2 bg-gray-300 rounded-md">Próximo</button>
            </div> --}}
            <div class="col-span-2 grid place-items-center ">

            </div>



            <div class=" grid place-items-end">
                <button type="button" wire:click='abrirModal'
                    class=" text-white px-8 py-2 rounded-lg bg-teal-700 hover:bg-teal-900 transition-all ease-in-out duration-300">
                    <i class="fa-solid fa-user-plus"></i> Adicionar
                </button>


                @if ($show == true)
                    <div class=" h-screen w-screen z-50 fixed grid place-items-center left-0 top-0"
                        style="background-color:rgba(0,0,0,0.6)">
                        <form wire:submit.prevent='CadastrarFuncionario'
                            class="w-full max-w-xl bg-white rounded-lg shadow-md p-6 space-y-4 relative">
                            <!-- Botão de fechar -->
                            <div class="absolute top-3 right-3">
                                <button type="button" wire:click='fecharModal'
                                    class="text-red-600 hover:text-red-800  transition-all duration-200 ease-in-out">
                                    <i class="fa-solid fa-xmark fa-lg"></i>
                                </button>
                            </div>
                            <p class="text-center font-bold text-2xl text-gray-700 mb-4">Cadastro de Funcionários</p>

                            <!-- Nome -->
                            <div>
                                <label for="nome" class="block text-sm font-medium text-gray-600 mb-1">Nome</label>
                                <input type="text" wire:model="nome" placeholder="Digite o nome completo"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                @error('nome')
                                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Data de Nascimento -->
                            <div>
                                <label for="nascimento" class="block text-sm font-medium text-gray-600 mb-1">Data de
                                    Nascimento</label>
                                <input type="date" wire:model="data_nascimento"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                @error('data_nascimento')
                                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email"
                                    class="block text-sm font-medium text-gray-600 mb-1">E-mail</label>
                                <input type="email" autocomplete="new-email" placeholder="exemplo@dominio.com"
                                    wire:model="email"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                @error('email')
                                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Senha -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-600 mb-1">Senha</label>
                                <input type="password" autocomplete="new-password" placeholder="Digite uma senha segura"
                                    wire:model="password"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                @error('password')
                                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Telefone -->
                            <div>
                                <label for="telefone"
                                    class="block text-sm font-medium text-gray-600 mb-1">Telefone</label>
                                <input type="tel" placeholder="(99) 99999-9999" wire:model="telefone"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                @error('telefone')
                                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Cargo -->
                            <div>
                                <label for="cargo"
                                    class="block text-sm font-medium text-gray-600 mb-1">Cargo</label>
                                <input type="text" placeholder="Ex: Atendente, Veterinário" wire:model="cargo"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                @error('cargo')
                                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror
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
            </div>

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
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-4">
            @foreach ($funcionarios as $item)
                <div wire:key='item-{{ $item->id }}'
                    class="grid gap-4 bg-white shadow-lg rounded-xl px-4 py-2 relative">
                    <div class="flex justify-between">
                        <div class="bg-green-600 rounded-lg px-2 py-1 grid place-items-center">
                            <p class="text-white font-medium ">Ativo</p>
                        </div>
                        <div class="relative">
                            <button type="button" wire:click='abrirModalOpcoes({{ $item['id'] }})'
                                class="cursor-pointer">
                                <i class="fa-solid fa-ellipsis text-gray-600 hover:text-gray-800 transition"></i>
                            </button>

                            @if ($modalAbertoParaId == $item['id'])
                                <div
                                    class="absolute top-0 right-0 w-48 bg-white shadow-lg rounded-lg border border-gray-200 z-30 py-4">
                                    <!-- Botão Fechar -->
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click='abrirModalOpcoes({{ $item['id'] }})'
                                            class="text-gray-400 hover:text-gray-600">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>

                                    <!-- Opções -->
                                    <div class="flex flex-col px-4  gap-2">
                                        <button type="button" wire:click='editarFuncionario({{ $item['id'] }})'
                                            class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 transition">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Editar
                                        </button>

                                        <!-- Botão Excluir com Confirmação -->
                                        <button type="button" wire:click='confirmarExclusao({{ $item['id'] }})'
                                            class="flex items-center gap-2 text-sm text-red-600 hover:text-red-800 transition">
                                            <i class="fa-solid fa-trash"></i>
                                            Excluir
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <!-- Modal de Confirmação -->
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
                            <!-- Mensagem de sucesso -->
                            @if (session()->has('message'))
                                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                                    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <!-- Mensagem de erro -->
                            @if (session()->has('error'))
                                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                                    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class=" flex flex-col items-center">
                        <div class=" grid place-items-center">
                            <img src="{{ $item['photo_path'] }}" alt="Usuário"
                                class="w-24 h-24 rounded-full object-cover">
                        </div>
                        <p>{{ $item['name'] }}</p>
                        <p>{{ $item['role'] }}</p>
                    </div>
                    <div class="mt-2 text-xs w-full bg-gray-100 p-2 rounded-md">
                        <ul class="space-y-1">
                            <li class="font-semibold truncate max-w-60">Email: {{ $item->email }}</li>
                            <li class="font-semibold truncate max-w-60">Telefone: {{ $item->phone }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="max-w-6xl mx-auto py-4">
        <div class="grid gap-4 ">
            {{ $funcionarios->links() }}
        </div>
    </div>
</section>
