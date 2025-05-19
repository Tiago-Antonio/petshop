<section class="h-screen w-screen bg-slate-100 overflow-x-hidden">
    <livewire:components.header.header />
    <div class=" max-w-screen-xl mx-auto grid grid-cols-4 gap-4 mt-8 px-8 ">
        <div class=" col-span-4 grid grid-cols-4 gap-4 ">
            <div class="relative w-full col-span-1">
                <input type="text" wire:model.live.debounce.100="nomeProduto" placeholder="Pesquisar"
                    class="w-full px-4 py-1 pr-10 rounded-lg border border-gray-300 focus:outline-none">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <div class=" grid place-items-end col-start-4">
                <button type="button" wire:click='abrirModalProduto'
                    class="text-white px-4 py-2 rounded-lg bg-teal-700 hover:bg-teal-900 transition-all ease-in-out duration-300">
                    <i class="fa-solid fa-box-open "></i>
                    <i class="fa-solid fa-plus "></i>
                </button>

                @if ($show == true)
                    <div class=" h-screen w-screen z-50 fixed grid place-items-center left-0 top-0"
                        style="background-color:rgba(0,0,0,0.6)">
                        <form wire:submit.prevent='CadastrarProduto'
                            class="w-full max-w-xl bg-white rounded-lg shadow-md p-6 space-y-4 relative">
                            <!-- Botão de fechar -->
                            <div class="absolute top-3 right-3">
                                <button type="button" wire:click='fecharModalProduto'
                                    class="text-red-600 hover:text-red-800  transition-all duration-200 ease-in-out">
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
                                <button type="button" @click="open = !open"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 text-left">

                                    <template x-if="selectedId">
                                        <span
                                            x-text="$refs.optionList.querySelector('[data-id=\'' + selectedId + '\']')?.innerText || 'Selecione um produto'"></span>
                                    </template>

                                    <template x-if="!selectedId">
                                        <span class="text-gray-400">Selecione um produto</span>
                                    </template>
                                </button>

                                <!-- Lista de opções -->
                                <div x-show="open" @click.outside="open = false" x-transition x-ref="optionList"
                                    class="absolute z-50 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-48 overflow-y-auto">
                                    @foreach ($dropdownProdutos as $produto)
                                        <div wire:key='produto-{{ $produto->id }}'
                                            class="px-4 py-2 hover:bg-blue-100 cursor-pointer"
                                            :class="{ 'bg-blue-200': selectedId == '{{ $produto->id }}' }"
                                            @click="selectedId = '{{ $produto->id }}'; open = false"
                                            data-id="{{ $produto->id }}">
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
                                <label for="quantity" class="block text-sm font-medium text-gray-600 mb-1">
                                    Quantidade
                                </label>
                                <input min="1" type="number" wire:model="quantity"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                @error('quantity')
                                    <span class="text-red-500 text-sm">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Preço Compra -->
                            <div>
                                <label for="unit_price" class="block text-sm font-medium text-gray-600 mb-1">
                                    Valor unitário
                                </label>
                                <input type="number" min="0.01" step="0.01" wire:model="unit_price"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                @error('unit_price')
                                    <span class="text-red-500 text-sm">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Data -->
                            <div>
                                <label for="entry_date" class="block text-sm font-medium text-gray-600 mb-1">
                                    Data
                                </label>
                                <input type="date" placeholder="Data" wire:model="entry_date"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                @error('entry_date')
                                    <span class="text-red-500 text-sm">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>


                            <!-- Botão -->
                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                                    Cadastrar
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

            @if (session()->has('successoCadastrar'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                    {{ session('successoCadastrar') }}
                </div>
            @endif

            @if (session()->has('erroCadastrar'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                    {{ session('erroCadastrar') }}
                </div>
            @endif

        </div>

        {{-- Selecionar Cliente --}}
        <div x-data="{ client_name: @entangle('client_name') }">

            <div x-show="client_name" x-transition.opacity @click="client_name = false"
                class="fixed inset-0 bg-black bg-opacity-50 z-40">
            </div>
            <div x-show="client_name" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                class="fixed inset-0 flex items-center justify-center z-50 p-4">

                <div class="bg-white w-full max-w-md rounded-2xl shadow-lg p-6 relative">

                    <h2 class="text-xl font-bold text-gray-800 text-center mb-4">Selecionar Cliente</h2>

                    <form wire:submit.prevent='clienteForms' class="grid gap-4">
                        <div>
                            <label for="client_id" class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                            <select id="client_id" wire:model='client_id' required
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Selecione um cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md shadow transition-all">
                            Confirmar
                        </button>
                        <button type="button" @click="client_name = false"
                            class="text-sm text-gray-500 hover:text-red-500 transition-all underline mx-auto">
                            Cancelar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Cards dos Produtos --}}
        <div class="col-span-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($produtos as $item)
                <div wire:key='item-{{ $item->id }}'
                    class="bg-white shadow-md rounded-2xl overflow-hidden hover:shadow-lg transition duration-300 relative">
                    {{-- Ícone de opções --}}
                    <div x-data="{ showOpcoes: false }" class="absolute top-2 right-2 z-10">
                        @if (auth()->user()->admin == 1)
                            <button @click="showOpcoes = !showOpcoes" class="text-gray-500 hover:text-gray-700">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                        @endif

                        <div x-show="showOpcoes" x-transition @click.away="showOpcoes = false"
                            class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-20">
                            <button
                                class="w-full text-left px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">Editar</button>
                            <button
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">Excluir</button>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col items-center relative h-full">
                        <img src="{{ asset($item['photo_path']) }}" alt="Produto"
                            class="w-32 h-32 rounded-full object-cover border border-gray-200 mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 text-center mb-1">{{ $item['name'] }}</h3>
                        <p class="text-sm text-gray-500 text-center mb-2 max-h-10 min-h-10 overflow-auto">
                            {{ $item['description'] ?? 'Descrição indisponível' }}</p>
                        <span class="text-xl font-bold text-blue-600 mb-4">R$
                            {{ number_format($item['sale_price'], 2, ',', '.') }}</span>
                        <button wire:click='adicionarCarrinho({{ $item->id }})'
                            class=" bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full transition text-sm shadow-sm">
                            Comprar
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="p-4 border border-t col-span-4">
            {{ $produtos->links() }}
        </div>
        {{-- Final do Card Produtos --}}

        <div x-data="{ open: false }" class="relative">
            <!-- Botão para abrir o carrinho -->
            <button @click="open = true"
                class="fixed top-10 right-4 bg-indigo-600 text-white p-3 rounded-full shadow-lg z-40">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span x-show="$wire.carrinho.length > 0"
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                    {{ $soma }}
                </span>
            </button>
            <!-- Overlay -->
            <div x-show="open" @click="open = false" class="fixed inset-0 bg-black bg-opacity-50 z-40"></div>
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-full"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-x-0"
                x-transition:leave-end="opacity-0 translate-x-full"
                class="fixed top-0 right-0 w-80 bg-white border-l border-gray-200 shadow-xl h-full flex flex-col z-50">
                <div
                    class="fixed top-0 right-0 w-80 bg-white border-l border-gray-200 shadow-xl h-full flex flex-col z-50 transform transition-transform duration-300 ease-in-out">

                    <!-- Header carrinho -->
                    <div class="bg-indigo-600 text-white p-4 flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="font-bold text-lg">Seu Carrinho</h3>
                        </div>
                        <span
                            class="bg-white text-indigo-600 rounded-full h-6 w-6 flex items-center justify-center text-sm font-semibold">
                            {{ $soma }}
                        </span>
                    </div>

                    <!-- Lista  -->
                    <div class="flex-1 overflow-y-auto p-4">
                        @if (count($carrinho) > 0)
                            <ul class="divide-y divide-gray-200">
                                @foreach ($carrinho as $index => $item)
                                    <li wire:key='carrinho-{{ $index }}'
                                        class="py-3 flex justify-between items-center">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="bg-gray-100 rounded-md h-12 w-12 flex items-center justify-center">
                                                @if (isset($item['imagem']))
                                                    <img src="{{ $item['imagem'] }}" alt="{{ $item['nome'] }}"
                                                        class="h-10 w-10 object-cover rounded">
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 text-gray-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $item['nome'] }}</p>
                                                <p class="text-sm text-gray-500">R$
                                                    {{ number_format($item['preco'], 2, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        {{-- Quantidade - Produtos --}}
                                        <div>
                                            {{ $item['quantidade'] }}
                                        </div>
                                        <button wire:click="removerCarrinho({{ $item['id'] }})"
                                            class="text-red-400 hover:text-red-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="h-full flex flex-col items-center justify-center text-center p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-3"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <p class="text-gray-500">Seu carrinho está vazio</p>
                                <p class="text-sm text-gray-400 mt-1">Adicione produtos para continuar</p>
                            </div>
                        @endif
                    </div>

                    <!-- Rodapé do carrinho -->
                    @if (count($carrinho) > 0)
                        <div class="border-t border-gray-200 p-4">
                            <div class="flex justify-between mb-3">
                                <span class="font-medium text-gray-600">Total:</span>
                                <span class="font-bold text-lg">R$
                                    {{ number_format($preco_total, 2, ',', '.') }}</span>
                            </div>
                            <button wire:click="finalizarPedido"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-lg font-medium flex items-center justify-center space-x-2 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Finalizar Pedido</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if (session()->has('sucessPedido'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                {{ session('sucessPedido') }}
            </div>
        @endif

        @if (session()->has('erroPedido'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
                {{ session('erroPedido') }}
            </div>
        @endif
</section>
