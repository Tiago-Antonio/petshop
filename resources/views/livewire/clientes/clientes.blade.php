<section class="min-h-screen w-screen bg-blue-100 pb-8">
    <livewire:components.header.header />
    <div class="grid grid-rows-[auto_1fr] h-[calc(100vh-4rem)] max-w-6xl mx-auto gap-4 py-4 px-8">
        <div class="flex flex-wrap justify-between items-center gap-4">
            <div class="relative ">
                <input type="text" wire:model.live.debounce.100="nomeCliente" placeholder="Pesquisar"
                    class="w-full px-4 py-2 bg-[#f5f5f5] border-b border-gray-400 focus:outline-none focus:border-blue-500 transition-all text-sm text-gray-800 placeholder-gray-500">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" wire:click='abrirModelAdicionar'
                    class="p-2 bg-[#2096f2] text-[#f5f5f5] hover:bg-blue-500 transition-all shadow-md">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <button wire:click="previousPage" class="p-2 bg-gray-300 hover:bg-gray-400 transition">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <button wire:click="nextPage"
                    class="p-2 bg-gray-300 hover:bg-gray-400 transition
                    @if ($clientes->currentPage() === $lastPage) opacity-50 cursor-not-allowed @endif"
                    @if ($clientes->currentPage() === $lastPage) disabled @endif>
                    <i class="fa-solid fa-arrow-right"></i>
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

            <!--Navegação antiga-->
            {{--
                <div class="p-4 border border-t">
                    {{ $clientes->links() }}
                </div>
            --}}

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
