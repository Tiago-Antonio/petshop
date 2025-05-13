<section class="h-screen w-screen bg-slate-100 overflow-x-hidden">
    <livewire:components.header.header />
    <div class="2xl:max-h-[calc(100vh-4rem)] max-w-7xl mx-auto grid grid-cols-4 gap-4 mt-8 px-8 ">
        <div class=" col-span-4 grid grid-cols-4 gap-4 ">
            <form  class="relative w-full col-span-1" wire:submit.prevent="buscar">
                <input type="text" wire:model.live.debounce.100="nomeFuncionario" placeholder="Pesquisar" class="w-full px-4 py-1 pr-10 rounded-lg border border-gray-300 focus:outline-none">
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
                <div class="grid gap-4 ">
                    {{ $funcionarios->links() }}
                </div>
            </div>

            

            <div class=" grid place-items-end">
                <button type="button" wire:click='abrirModal'  class=" text-white px-4 py-2 rounded-lg bg-teal-700 hover:bg-teal-600 transition-all ease-in-out duration-300">
                    <i class="fa-solid fa-user-plus"></i> Adicionar
                </button>
                
                @if($show == true)
                <div class=" h-screen w-screen z-50 fixed grid place-items-center left-0 top-0" style="background-color:rgba(0,0,0,0.6)">
                    <form wire:submit='CadastrarFuncionario' class="w-full max-w-xl bg-white rounded-lg shadow-md p-6 space-y-4 relative">
                         <!-- Botão de fechar -->
                        <div class="absolute top-3 right-3">
                            <button type="button" wire:click='fecharModal' class="text-red-600 hover:text-red-800  transition-all duration-200 ease-in-out">
                                <i class="fa-solid fa-xmark fa-lg"></i>
                            </button>
                        </div>
                        <p class="text-center font-bold text-2xl text-gray-700 mb-4">Cadastro de Funcionários</p>
                    
                        <!-- Nome -->
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-600 mb-1">Nome</label>
                            <input type="text" wire:model="nome" placeholder="Digite o nome completo"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    
                        <!-- Data de Nascimento -->
                        <div>
                            <label for="nascimento" class="block text-sm font-medium text-gray-600 mb-1">Data de Nascimento</label>
                            <input type="date"  wire:model="data_nascimento"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    
                        <!-- Email -->
                        <div>
                            <label for="email"  class="block text-sm font-medium text-gray-600 mb-1">E-mail</label>
                            <input type="email" autocomplete="new-email" placeholder="exemplo@dominio.com" wire:model="email"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    
                        <!-- Senha -->
                        <div>
                            <label for="password"  class="block text-sm font-medium text-gray-600 mb-1">Senha</label>
                            <input type="password" autocomplete="new-password"  placeholder="Digite uma senha segura" wire:model="password"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    
                        <!-- Telefone -->
                        <div>
                            <label for="telefone" class="block text-sm font-medium text-gray-600 mb-1">Telefone</label>
                            <input type="tel"  placeholder="(99) 99999-9999" wire:model="telefone"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    
                        <!-- Cargo -->
                        <div>
                            <label for="cargo" class="block text-sm font-medium text-gray-600 mb-1">Cargo</label>
                            <input type="text"  placeholder="Ex: Atendente, Veterinário" wire:model="cargo"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    
                        <!-- Botão -->
                        <div class="pt-4">
                            <button
                                class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                                Cadastrar
                            </button>
                        </div>
                       
                    </form>
                </div>
                @endif
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
           
        </div>
        @foreach ($funcionarios as $item)
            <div class="grid gap-4 bg-white shadow-lg rounded-md px-4 py-2 relative">
                <div class="flex justify-between">
                    <p>Ativo</p>
                    <div class="relative">
                        <button type="button" wire:click='abrirModalOpcoes({{ $item['id'] }})' class="cursor-pointer">
                            <i class="fa-solid fa-ellipsis text-gray-600 hover:text-gray-800 transition"></i>
                        </button>
                    
                        @if ($modalAbertoParaId ==  $item['id'])
                        <div x-transition class="absolute top-0 right-0 w-48 bg-white shadow-lg rounded-lg border border-gray-200 z-50 py-4">
                            <!-- Botão Fechar -->
                            <div class="absolute right-2 top-2">
                                <button type="button" wire:click='abrirModalOpcoes({{ $item['id'] }})'  class="text-gray-400 hover:text-gray-600">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        
                            <!-- Opções -->
                            <div class="flex flex-col px-4  gap-2">
                                <button type="button" wire:click='editarFuncionario({{ $item['id'] }})'  class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Editar
                                </button>
                
                                <!-- Botão Excluir com Confirmação -->
                                <button type="button" @click="confirmando = true" class="flex items-center gap-2 text-sm text-red-600 hover:text-red-800 transition">
                                    <i class="fa-solid fa-trash"></i>
                                    Excluir
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Modal de Confirmação -->
                        @if($confirmando == true)
                        <div x-transition @click.away="confirmando = false" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                            <div class="bg-white rounded-lg p-6 shadow-xl">
                                <h2 class="text-lg font-semibold text-gray-800 mb-4">Tem certeza?</h2>
                                <p class="text-sm text-gray-600 mb-6">Essa ação não poderá ser desfeita.</p>
                                <div class="flex justify-end gap-4">
                                    <button @click="confirmando = false" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</button>
                                    <button wire:click='excluirFuncionario({{ $item['id'] }})' @click="confirmando = false" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                        Confirmar
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                      <!-- Mensagem de sucesso -->
                        @if (session()->has('message'))
                            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                                {{ session('message') }}
                            </div>
                        @endif

                        <!-- Mensagem de erro -->
                        @if (session()->has('error'))
                            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class=" flex flex-col items-center">
                    <div class=" grid place-items-center">
                        <img src="{{ $item['photo_path'] }}" alt="Usuário" class="w-24 h-24 rounded-full object-cover">
                    </div>
                    <p>{{ $item['name'] }}</p>
                    <p>{{ $item['role'] }}</p>
                </div>
                <div class=" border border-black bg-slate-200 rounded-lg px-4 py-2">
                    <ul class="max-h-[86px] overflow-auto">
                        <li class="text-sm truncate max-w-56">Nome: {{ $item['name'] }}</li>
                        <li class="text-sm truncate max-w-56">Email: {{ $item['email'] }}</li>
                        <li class="text-sm truncate max-w-56" >Telefone: {{ $item['phone'] }}</li>
                    </ul>
                </div>
            </div>
            
        @endforeach
       
        
    </div>
    
</section>
