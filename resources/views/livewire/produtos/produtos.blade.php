<section class="h-screen w-screen bg-slate-100 overflow-x-hidden">
    <livewire:components.header.header />
    <div class="2xl:max-h-[calc(100vh-4rem)] max-w-7xl mx-auto grid grid-cols-4 gap-4 mt-8 px-8 ">
        <div class=" col-span-4 grid grid-cols-4 gap-4 ">
            <form  class="relative w-full col-span-1" wire:submit.prevent="buscar">
                <input type="text" wire:model.live.debounce.100="nomeProduto" placeholder="Pesquisar" class="w-full px-4 py-1 pr-10 rounded-lg border border-gray-300 focus:outline-none">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <div class=" grid place-items-end col-start-4">
                <button type="button" wire:click='abrirModalProduto' class="text-white px-4 py-2 rounded-lg bg-teal-700 hover:bg-teal-600 transition-all ease-in-out duration-300">
                    <i class="fa-solid fa-box-open "></i>
                    <i class="fa-solid fa-plus "></i>
                </button>
                
                @if($show == true)
                <div class=" h-screen w-screen z-50 fixed grid place-items-center left-0 top-0" style="background-color:rgba(0,0,0,0.6)">
                    <form wire:submit.prevent='CadastrarProduto' class="w-full max-w-xl bg-white rounded-lg shadow-md p-6 space-y-4 relative">
                         <!-- Botão de fechar -->
                        <div class="absolute top-3 right-3">
                            <button type="button" wire:click='fecharModalProduto' class="text-red-600 hover:text-red-800  transition-all duration-200 ease-in-out">
                                <i class="fa-solid fa-xmark fa-lg"></i>
                            </button>
                        </div>
                        <p class="text-center font-bold text-2xl text-gray-700 mb-4">Cadastro de Produtos</p>
                    
                        <!-- Nome / produtoID -->
                       <div x-data="{ open: false, selectedId: @entangle('product_id') }" class="relative">
                            <label for="product_id" class="block text-sm font-medium text-gray-600 mb-1">
                                Produto
                            </label>

                            <!-- Botão de abertura -->
                            <button 
                                type="button" 
                                @click="open = !open" 
                                class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 text-left">
                                
                                <template x-if="selectedId">
                                    <span x-text="$refs.optionList.querySelector('[data-id=\'' + selectedId + '\']')?.innerText || 'Selecione um produto'"></span>
                                </template>

                                <template x-if="!selectedId">
                                    <span class="text-gray-400">Selecione um produto</span>
                                </template>
                            </button>

                            <!-- Lista de opções -->
                            <div 
                                x-show="open" 
                                @click.outside="open = false"
                                x-transition 
                                x-ref="optionList"
                                class="absolute z-50 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-48 overflow-y-auto"
                            >
                                @foreach ($dropdownProdutos as $produto)
                                    <div 
                                        class="px-4 py-2 hover:bg-blue-100 cursor-pointer" 
                                        :class="{ 'bg-blue-200': selectedId == '{{ $produto->id }}' }" 
                                        @click="selectedId = '{{ $produto->id }}'; open = false" 
                                        data-id="{{ $produto->id }}"
                                    >
                                        {{ $produto->name }}
                                    </div>
                                @endforeach
                            </div>

                            @error('product_id') 
                                <span class="text-red-500 text-sm">{{ $message }}</span> 
                            @enderror
                        </div>

                        <!-- Fornecedor / FornecedorID -->
                        {{-- <div>
                            <label for="description" class="block text-sm font-medium text-gray-600 mb-1">Nome</label>
                            <input type="text" wire:model="description" placeholder="Descrição do produto"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div> --}}

                         <!-- Quantidade -->
                        <div>
                            <label 
                                for="quantity" 
                                class="block text-sm font-medium text-gray-600 mb-1">
                                Quantidade
                            </label>
                            <input 
                                type="number"  
                                wire:model="quantity"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                 @error('quantity') 
                                    <span 
                                        class="text-red-500 text-sm">
                                        {{ $message }}
                                    </span> 
                                @enderror
                        </div>
                    
                        <!-- Preço Compra -->
                        <div>
                            <label 
                                for="unit_price" 
                                class="block text-sm font-medium text-gray-600 mb-1">
                                Valor unitário
                            </label>
                            <input 
                                type="number" 
                                step="0.01"  
                                wire:model="unit_price"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                @error('unit_price') 
                                    <span 
                                        class="text-red-500 text-sm">
                                        {{ $message }}
                                    </span> 
                                @enderror
                        </div>
    
                        <!-- Data -->
                        <div>
                            <label 
                                for="entry_date"  
                                class="block text-sm font-medium text-gray-600 mb-1">
                                Data
                            </label>
                            <input 
                                type="date"   
                                placeholder="Data" 
                                wire:model="entry_date"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                 @error('entry_date') 
                                    <span 
                                        class="text-red-500 text-sm">
                                        {{ $message }}
                                    </span> 
                                @enderror
                        </div>
                    
                       
                        <!-- Botão -->
                        <div class="pt-4">
                            <button 
                                type="submit"
                                class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                                Cadastrar
                            </button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
            
           @if (session()->has('successoCadastrar'))
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 3000)" 
                    x-show="show"
                    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                    {{ session('successoCadastrar') }}
                </div>
            @endif

            @if (session()->has('erroCadastrar'))
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 3000)" 
                    x-show="show"
                    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                    {{ session('erroCadastrar') }}
                </div>
            @endif
           
        </div>
        <div class="col-span-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($produtos as $item)
                <div class="bg-white shadow-md rounded-2xl overflow-hidden hover:shadow-lg transition duration-300 relative">
                    {{-- Ícone de opções --}}
                    <div x-data="{ showOpcoes: false }" class="absolute top-2 right-2 z-10">
                        @if(auth()->user()->admin == 1)
                        <button @click="showOpcoes = !showOpcoes" class="text-gray-500 hover:text-gray-700">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        @endif

                        <div x-show="showOpcoes" x-transition @click.away="showOpcoes = false"
                            class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-20">
                            <button  class="w-full text-left px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">Editar</button>
                            <button  class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">Excluir</button>
                        </div>
                    </div>
                    

                    {{-- Imagem --}}
                    <div class="p-4 flex flex-col items-center">
                        <img src="{{ asset($item['photo_path']) }}" alt="Produto"
                            class="w-32 h-32 rounded-full object-cover border border-gray-200 mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 text-center mb-1">{{ $item['name'] }}</h3>
                        <p class="text-sm text-gray-500 text-center mb-2">{{ $item['description'] ?? 'Descrição indisponível' }}</p>
                        <span class="text-xl font-bold text-blue-600 mb-4">R$ {{ number_format($item['sale_price'], 2, ',', '.') }}</span>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full transition text-sm shadow-sm">
                            Comprar
                        </button>
                    </div>
                </div>
            @endforeach
             
        </div>
        <div class="p-4 border border-t">
            {{ $produtos->links() }}
        </div>
        
    </div>
</section>
