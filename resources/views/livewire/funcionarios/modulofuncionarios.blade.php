<section class="h-screen w-screen bg-blue-100 overflow-x-hidden">
    <livewire:components.header.header />

    <div class="grid grid-rows-[auto_1fr] h-[calc(100vh-4rem)] max-w-6xl mx-auto gap-4 py-4 px-8">
        <!-- Primeira linha -->
        <div class="grid gap-2 2xl:gap-4 h-full">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <!-- Campo de pesquisa -->
                <div class="relative">
                    <form wire:submit.prevent="buscar">                    
                        <input type="text" wire:model.live.debounce.100="nomeFuncionario" placeholder="Pesquisar" class="w-full px-4 py-2 bg-[#f5f5f5] border-b border-gray-400 focus:outline-none focus:border-blue-500 transition-all text-sm text-gray-800 placeholder-gray-500">
                        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <!-- Botoes de interacao -->
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
                    <button wire:click="nextPage" class="p-2 bg-gray-300 hover:bg-gray-400 transition">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
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
                    <p class="text-center font-bold text-2xl text-gray-700 mb-4">Cadastro de Funcionários</p>

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
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-4">
            @foreach ($funcionarios as $item)
                <div wire:key='item-{{ $item->id }}' class="grid gap-4 bg-white shadow-lg rounded-xl px-4 py-2 relative">
                    <div class="flex justify-between">
                        <div class="bg-green-600 rounded-lg px-2 py-1 grid place-items-center">
                            <p class="text-white font-medium">Ativo</p>
                        </div>
                        <div class="relative">
                            <button type="button" wire:click='abrirModalOpcoes({{ $item['id'] }})'
                                class="cursor-pointer">
                                <i class="fa-solid fa-ellipsis text-gray-600 hover:text-gray-800 transition"></i>
                            </button>

                            @if ($modalAbertoParaId == $item['id'])
                                <div class="absolute top-0 right-0 w-48 bg-white shadow-lg rounded-lg border border-gray-200 z-30 py-4">
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
                                <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
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

                    <div class="flex flex-col items-center">
                        <div class="grid place-items-center">
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

        <!-- Paginação -->
        <div class="max-w-6xl mx-auto py-4">
            <div class="grid gap-4">
                {{ $funcionarios->links() }}
            </div>
        </div>
    </div>
</section>
