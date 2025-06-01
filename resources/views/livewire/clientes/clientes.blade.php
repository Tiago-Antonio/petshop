<section class="max-h-screen w-screen bg-blue-100 pb-8 overflow-hidden">
    <div wire:loading wire:target='gerarRelatorio'
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
    <button wire:click="gerarRelatorio" title="Gerar Relatório"
        class="fixed bottom-6 right-20 bg-indigo-600 hover:bg-indigo-800 text-white p-4 rounded-full shadow-lg z-50 transition ">
        <i class="fa-solid fa-file-pdf fa-lg"></i>
    </button>
    <div x-data="{ showChart: false }">
        <button @click="showChart = !showChart" title="Exibir Gráfico"
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
                    class="hidden md:block h-full row-span-2 2xl:row-span-1 shadow-md bg-white rounded-3xl p-2 2xl:p-4 overflow-auto mt-2">
                    <div class="relative h-full">
                        <canvas id="clientesChart" style="width: 100%; height: 100%;"></canvas>
                    </div>

                    <script>
                        const ctxClientes = document.getElementById('clientesChart').getContext('2d');

                        const labelsClientes = @json($query_clientes->pluck('name'));
                        const dataClientes = @json($query_clientes->pluck('total_compras'));

                        new Chart(ctxClientes, {
                            type: 'bar',
                            data: {
                                labels: labelsClientes,
                                datasets: [{
                                    label: 'Total de Compras por Cliente',
                                    data: dataClientes,
                                    backgroundColor: 'rgba(153, 102, 255, 0.5)',
                                    borderColor: 'rgba(153, 102, 255, 1)',
                                    borderWidth: 1
                                }]
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

    <div class="grid grid-rows-[auto_1fr] h-[calc(100vh-4rem)] max-w-7xl mx-auto gap-4 py-4 px-8">
        <div class="flex flex-wrap justify-between items-center gap-4">
            <div class="relative ">
                <input type="text" wire:model.live.debounce.200="nomeCliente" placeholder="Pesquisar"
                    class="w-full px-4 py-2 bg-white border-b border-gray-400 focus:outline-none focus:border-blue-500 transition-all text-sm text-gray-800 placeholder-gray-500 lg:min-w-64">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="flex items-center gap-2gap-4">
                <button type="button" wire:click='abrirModelAdicionar'
                    class=" col-start-2 max-h-11 text-white px-2 py-2 rounded-lg bg-teal-700 hover:bg-teal-900 transition-all ease-in-out duration-300">
                    <i class="fa-solid fa-user-plus"></i> Adicionar
                </button>
            </div>

            @if ($show == true)
                <div class=" h-screen w-screen z-50 fixed grid place-items-center left-0 top-0"
                    style="background-color:rgba(0,0,0,0.6)">
                    <form wire:submit.prevent='CadastrarCliente'
                        class="w-full max-w-xl bg-white rounded-lg shadow-md p-6 space-y-4 relative">
                        <!-- Botão de fechar -->
                        <div class="absolute top-3 right-3">
                            <button type="button" wire:click='fecharModelAdicionar'
                                class="text-red-600 hover:text-red-800  transition-all duration-200 ease-in-out">
                                <i class="fa-solid fa-xmark fa-lg"></i>
                            </button>
                        </div>
                        <p class="text-center font-bold text-2xl text-gray-700 mb-4">Cadastro de Clientes</p>

                        <!-- Nome -->
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-600 mb-1">Nome</label>
                            <input type="text" wire:model="nome" placeholder="Digite o nome completo"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('nome')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-600 mb-1">E-mail</label>
                            <input type="email" autocomplete="new-email" placeholder="exemplo@dominio.com"
                                wire:model="email"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('email')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Telefone -->
                        <div>
                            <label for="telefone" class="block text-sm font-medium text-gray-600 mb-1">Telefone</label>
                            <input type="tel" placeholder="(99) 99999-9999" wire:model="telefone"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('telefone')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Endereço -->
                        <div>
                            <label for="endereco" class="block text-sm font-medium text-gray-600 mb-1">Endereço</label>
                            <input type="text" placeholder="Rua..." wire:model="endereco"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('endereco')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Foto -->
                        <div>
                            <label for="imagem" class="block text-sm font-medium text-gray-600 mb-1">Imagem</label>
                            <input type="file" placeholder="Rua..." wire:model="photo_path"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('photo_path')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                            <div wire:loading wire:target='photo_path'>
                                <span class="text-green-500 font-semibold text-sm">Carregando imagem...</span>
                            </div>
                        </div>

                        <!-- Cadastrar -->
                        <div class="pt-4">
                            <button
                                class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                                @if ($clienteId)
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

        <div x-data="{ confirmando: false, clienteIdParaExcluir: null }" class="overflow-x-auto  mt-2 ">
            <table class="min-w-full table-auto rounded-xl shadow-lg bg-white">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Telefone</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Endereço</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-blue-100">
                    @foreach ($clientes as $item)
                        <tr wire:key='item-{{ $item->id }}' class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                                <img src="{{ asset('storage/' . $item->photo_path) }}" alt="Clientes"
                                    class="w-12 h-12 rounded-full object-cover object-top">
                                <span>{{ $item['name'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item['email'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item['phone'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item['address'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" wire:click='editarCliente({{ $item['id'] }})'
                                        class="flex items-center gap-1 px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded hover:bg-blue-600 transition">
                                        ✏️ Editar
                                    </button>
                                    <button @click="confirmando = true; clienteIdParaExcluir = {{ $item['id'] }}"
                                        class="flex items-center gap-1 px-3 py-1 text-sm font-medium text-white bg-red-500 rounded hover:bg-red-600 transition">
                                        🗑️ Excluir
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="p-4 border border-t">
                {{ $clientes->links() }}
            </div>



            <!-- Modal de Confirmação-->
            <div x-show="confirmando" x-transition @click.away="confirmando = false"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-lg p-6 shadow-xl">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Tem certeza?</h2>
                    <p class="text-sm text-gray-600 mb-6">Essa ação não poderá ser desfeita.</p>
                    <div class="flex justify-end gap-4">
                        <button @click="confirmando = false"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</button>
                        <button @click="confirmando = false; $wire.excluirCliente(clienteIdParaExcluir)"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mensagens de sucesso ou erro -->
            @if (session()->has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                    {{ session('error') }}
                </div>
            @endif
            @if (session()->has('erro'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                    {{ session('erro') }}
                </div>
            @endif
        </div>

    </div>
</section>