<section class="h-screen w-screen bg-[#f5f5f5]">
    <livewire:components.header.header />
    <div class="grid grid-rows-[auto_1fr] h-[calc(100vh-4rem)] max-w-6xl mx-auto gap-4 py-4 px-8">
        <!-- Primeira linha -->
        <div class="grid gap-2 2xl:gap-4 h-full">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <!-- Campo de pesquisa -->
                <input 
                type="text" 
                class="w-full sm:w-1/3 px-4 py-2 bg-[#f5f5f5] border-b border-gray-400 focus:outline-none focus:border-blue-500 transition-all text-sm text-gray-800 placeholder-gray-500"
                placeholder="Pesquisar fornecedores" 
                />

                <div class="flex items-center gap-2">
                    <!-- Botão Adicionar -->
                    <button class="p-2 bg-[#2096f2] text-[#f5f5f5] hover:bg-blue-500 transition-all shadow-md">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    
                    <!-- Botão Excluir -->
                    <button type="button" wire:click='openModalSupplierDelete' 
                        class="p-2 bg-[#2096f2] text-[#f5f5f5] hover:bg-red-600 transition-all shadow-md">
                        <i class="fa-solid fa-trash"></i>
                    </button>

                    <!-- Paginação -->
                    <button wire:click="previousPage" class="p-2 bg-gray-300 hover:bg-gray-400 transition">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <button wire:click="nextPage" class="p-2 bg-gray-300 hover:bg-gray-400 transition">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>

                    <!-- Modal de confirmação de exclusão de fornecedores selecionados -->
                    @if($show == true)
                    <div x-transition @click.away="" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                        <div class="bg-white rounded-lg p-6 shadow-xl">
                            <h2 class="text-lg font-semibold text-gray-800">Tem certeza?</h2>
                            <p class="text-sm text-gray-600 mb-6">Essa ação não poderá ser desfeita.</p>
                            <div class="flex justify-end gap-4">
                                <button wire:click='closeModalSupplierDelete' class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</button>
                                <button wire:click='deleteSelectedSuppliers' class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
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
        </div>

        <!-- Segunda linha -->
        <div class="h-full row-span-2 2xl:row-span-1 grid grid-cols-1 gap-4 overflow-auto">
            <div class="overflow-x-auto bg-[#f5f5f5] shadow-lg rounded-3xl">
                <table class="min-w-full table-auto text-left border-separate border-spacing-y-2">
                    <thead class="bg-[#f5f5f5]">
                        <tr>
                            <th class="px-4 py-2 text-gray-400 text-sm font-normal leading-tight"><i class="fa-regular fa-square-check"></i></th>
                            <th class="px-4 py-2 text-gray-400 text-sm font-normal leading-tight">Nome</th>
                            <th class="px-4 py-2 text-gray-400 text-sm font-normal leading-tight">E-mail</th>
                            <th class="px-4 py-2 text-gray-400 text-sm font-normal leading-tight">Telefone</th>
                            <th class="px-4 py-2 text-gray-400 text-sm font-normal leading-tight">Endereço</th>
                            <th class="px-4 py-2 text-gray-400 text-sm font-normal leading-tight">Editar</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $item)
                            <tr class="bg-[#fefeff] shadow">
                                <td class="px-4 py-2 h-16 text-gray-800 text-center ">
                                    <input type="checkbox"
                                    wire:model="selectedSuppliers"
                                    value="{{ $item['id'] }}"
                                    class="w-5 h-5 accent-[#2096f2] cursor-pointer">
                                </td>
                                <td class="px-4 py-2 h-16 text-gray-800 align-middle">{{$item['name']}}</td>
                                <td class="px-4 py-2 h-16 text-gray-800 align-middle">{{$item['email']}}</td>
                                <td class="px-4 py-2 h-16 text-gray-800 align-middle">{{$item['phone']}}</td>
                                <td class="px-4 py-2 h-16 text-gray-500 text-sm align-middle">{{$item['address']}}</td>
                                <td class="px-4 py-2 h-16 text-gray-500 text-sm text-center align-middle">
                                    <button type="button" wire:click='editarFuncionario({{ $item["id"] }})' class="flex items-center justify-center w-full h-full text-gray-700 hover:text-blue-600 transition">
                                        <i class="fa-solid fa-pen-to-square text-base leading-none"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</section>
