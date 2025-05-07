<section class="min-h-screen w-screen bg-blue-100 pb-8" x-data="{ show: false }">
    <livewire:components.header.header />

    <div class="max-w-6xl mx-auto mt-12 px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Clientes</h1>
        <div class="col-span-4 grid grid-cols-4 gap-4">
            <div  class="relative w-full col-span-1 ">
                <input type="text" wire:model.debounce.100="nome_funcionario" placeholder="Pesquisar" class="w-full px-4 py-1 pr-10 rounded-lg border border-gray-300 focus:outline-none">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class=" col-span-2 flex justify-center ">
                <button wire:click="previousPage" class="px-4 py-2 bg-gray-300 rounded-md mr-2">Anterior</button>
                <button wire:click="nextPage" class="px-4 py-2 bg-gray-300 rounded-md">Próximo</button>
            </div>
            <div class="col-span-1 grid grid-cols-2 ">
                <button type="button" @click="show = true"  class=" col-start-2 max-h-11 text-white px-4 py-2 rounded-lg bg-teal-700 hover:bg-teal-600 transition-all ease-in-out duration-300">
                    <i class="fa-solid fa-user-plus"></i> Adicionar
                </button>
            </div>
                
            <div x-show="show"  class=" h-screen w-screen z-50 fixed grid place-items-center left-0 top-0" style="background-color:rgba(0,0,0,0.6)">
                <form wire:submit='CadastrarCliente' class="w-full max-w-xl bg-white rounded-lg shadow-md p-6 space-y-4 relative">
                     <!-- Botão de fechar -->
                    <div class="absolute top-3 right-3">
                        <button type="button" @click="show = false"  class="text-red-600 hover:text-red-800  transition-all duration-200 ease-in-out">
                            <i class="fa-solid fa-xmark fa-lg"></i>
                        </button>
                    </div>
                    <p class="text-center font-bold text-2xl text-gray-700 mb-4">Cadastro de Clientes</p>
                
                    <!-- Nome -->
                    <div>
                        <label for="nome" class="block text-sm font-medium text-gray-600 mb-1">Nome</label>
                        <input type="text" wire:model="nome" placeholder="Digite o nome completo"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                
                    <!-- Email -->
                    <div>
                        <label for="email"  class="block text-sm font-medium text-gray-600 mb-1">E-mail</label>
                        <input type="email" autocomplete="new-email" placeholder="exemplo@dominio.com" wire:model="email"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
            
                
                    <!-- Telefone -->
                    <div>
                        <label for="telefone" class="block text-sm font-medium text-gray-600 mb-1">Telefone</label>
                        <input type="tel"  placeholder="(99) 99999-9999" wire:model="telefone"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- Endereço -->
                    <div>
                        <label for="endereco" class="block text-sm font-medium text-gray-600 mb-1">Endereço</label>
                        <input type="text"  placeholder="Rua..." wire:model="endereco"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                
                    <!-- Botão -->
                    <div class="pt-4">
                        <button type="submit" @click="show = false"
                            class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                            Cadastrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @if (session()->has('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session()->has('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                {{ session('error') }}
            </div>
        @endif

        <div x-data="{ confirmando: false, clienteIdParaExcluir: null }" class="overflow-x-auto rounded-xl shadow-lg bg-white mt-2 ">
            <table class="min-w-full table-auto">
                <thead class="bg-blue-200 text-blue-800">
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
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                                <img src="{{ $item['photo_path'] }}" alt="Clientes" class="w-12 h-12 rounded-full object-cover object-top">
                                <span>{{ $item['name'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item['email'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item['phone'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item['address'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-center gap-2">
                                    <button  type="button" @click="$wire.editarCliente({{ $item['id'] }}); showOpcoes = false; show = true"  class="flex items-center gap-1 px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded hover:bg-blue-600 transition">
                                        ✏️ Editar
                                    </button>
                                    <button 
                                        @click="confirmando = true; clienteIdParaExcluir = {{ $item['id'] }}"
                                        class="flex items-center gap-1 px-3 py-1 text-sm font-medium text-white bg-red-500 rounded hover:bg-red-600 transition">
                                        🗑️ Excluir
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        
            <!-- Modal de Confirmação-->
            <div x-show="confirmando" x-transition @click.away="confirmando = false" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-lg p-6 shadow-xl">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Tem certeza?</h2>
                    <p class="text-sm text-gray-600 mb-6">Essa ação não poderá ser desfeita.</p>
                    <div class="flex justify-end gap-4">
                        <button @click="confirmando = false" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</button>
                        <button 
                            @click="confirmando = false; $wire.excluirCliente(clienteIdParaExcluir)" 
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        
            <!-- Mensagens de sucesso ou erro -->
            @if (session()->has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                    {{ session('message') }}
                </div>
            @endif
        
            @if (session()->has('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    

</section>
