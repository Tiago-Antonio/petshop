<div class="bg-blue-100 min-h-screen w-full overflow-hidden " wire:poll>
    @livewire('components.header.header')


    {{-- Mensagens da sessão --}}
    @if (session()->has('sucesso'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
            {{ session('sucesso') }}
        </div>
    @endif

    @if (session()->has('erro'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-md transition-all duration-300">
            {{ session('erro') }}
        </div>
    @endif


    <div wire:loading wire:target='gerarPdfVenda'
        class="fixed inset-0 h-screen w-screen  z-50 flex items-center justify-center"
        style="background-color: rgba(0, 0, 0, 0.8)">
        <div class="h-full w-full grid place-items-center ">
            <div>
                <div class="relative w-20 h-20 mb-4 mx-auto">
                    <svg class="animate-spin w-full h-full text-blue-300" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
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

    @if ($pagamento)
        <div class="bg-black fixed inset-0 bg-opacity-50 z-50">
            <form wire:submit.prevent="confirmarPagamento"
                class="fixed z-50 max-w-md w-full mx-auto left-1/2 -translate-x-1/2 bg-white rounded-md top-1/2 -translate-y-1/2 p-6 shadow-lg">

                <h2 class="text-lg font-semibold mb-4 text-gray-800">Escolha um Método de Pagamento</h2>

                <div class="px-3 py-2 mb-4 ">
                    <label for="escolhaMetodoPagamento"
                        class="block text-sm font-medium text-gray-700 mb-1">Método:</label>
                    <select id="escolhaMetodoPagamento" name="metodoPagamento" wire:model="escolhaMetodoPagamento"
                        class="w-full border border-gray-300 rounded-md focus:outline-none min-h-8">
                        <option value="">Selecione...</option>
                        <option value="1">Cartão crédito</option>
                        <option value="2">Cartão débito</option>
                        <option value="3">Dinheiro</option>
                        <option value="4">Pix</option>
                    </select>
                    @error('escolhaMetodoPagamento')
                        <span class="text-red-600 text-sm font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">

                    <button type="button" wire:click="$set('pagamento', false)"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-xl px-4 py-1 font-semibold">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-900 rounded-xl px-4 py-1 text-white font-semibold">
                        Confirmar
                    </button>
                </div>
            </form>
        </div>
    @endif

    <div class="overflow-x-auto px-4 py-8 max-w-screen-xl mx-auto ">
        <div class=" flex justify-between">
            <div class="relative w-full md:w-1/2 xl:w-1/4">
                <input type="text" wire:model.live.debounce.100="query" placeholder="Pesquisar"
                    class="w-full px-4 py-2 bg-[#f5f5f5] border-b border-gray-400 focus:outline-none focus:border-blue-500 transition-all text-sm text-gray-800 placeholder-gray-500">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div>
                <button wire:click='gerarPdfVenda'
                    class=" bg-blue-600 px-4 py-1 rounded-md text-white font-semibold hover:bg-blue-800 transition flex gap-2 items-center justify-center min-h-11">
                    <i class="fa-solid fa-file-arrow-down"></i>
                    <p>Gerar PDF</p>
                </button>
            </div>
        </div>
        <table class="min-w-full bg-white shadow-md rounded-xl overflow-hidden mt-4">
            <thead class="bg-blue-600 text-white shadow">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">Id</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">Cliente</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">Vendedor</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">Produtos</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">Total</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">Data</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider w-60">Ações
                    </th>
                </tr>
            </thead>

            @foreach ($pedidos as $item)
                <tbody class="" x-data="{ showProducts{{ $item->id }}: false }" wire:key='group-{{ $item->id }}'>
                    <tr class="hover:bg-gray-100 transition-colors duration-200">
                        <td class="px-4 py-4 text-sm text-gray-800">{{ $item['id'] }}</td>
                        <td class="px-4 py-4 text-sm text-gray-800">{{ $item->client->name }}</td>
                        <td class="px-4 py-4 text-sm text-gray-800">{{ $item->user->name }}</td>
                        <td class="px-4 py-4 text-sm text-gray-800">
                            <button
                                type="button"x-on:click="showProducts{{ $item->id }} = !showProducts{{ $item->id }}"
                                class="flex items-center gap-1.5 bg-blue-500/10 text-blue-600 text-xs font-medium px-3 py-1.5 rounded-md hover:bg-blue-500/20 transition-colors border border-blue-500/20">
                                <div x-show="!showProducts{{ $item->id }}" class="w-4 h-4">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <div x-show="showProducts{{ $item->id }}" class="w-4 h-4">
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                                <span>Produtos</span>
                            </button>
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-800">
                            R${{ number_format($item['total_amount'], 2, ',', '.') }}</td>
                        <td class="px-4 py-4 text-sm text-gray-800">
                            @if ($item['status'] == 'pendente')
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst($item['status']) }}
                                </span>
                            @elseif($item['status'] == 'finalizado')
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ ucfirst($item['status']) }}
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    {{ ucfirst($item['status']) }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-800">{{ $item->created_at->format('d/m/y') }}
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-800">
                            @if ($item['status'] == 'pendente')
                                <div class="flex gap-2">
                                    <button wire:click='metodoPagamento({{ $item->id }})'
                                        class="px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Confirmar
                                    </button>
                                    <button wire:click='modalCancelarVenda({{ $item->id }})'
                                        class="px-3 py-1 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Cancelar
                                    </button>
                                </div>
                            @elseif($item['status'] == 'cancelado')
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Pedido
                                    cancelado</span>
                            @elseif($item['status'] == 'finalizado')
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Pedido
                                    finalizado</span>
                            @endif


                            <!-- Modal de Confirmação -->
                            @if ($confirmando === $item['id'])
                                <div
                                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                    <div class="bg-white rounded-lg p-6 shadow-xl">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Tem certeza?</h2>
                                        <p class="text-sm text-gray-600 mb-6">Essa ação não poderá ser desfeita.</p>
                                        <div class="flex justify-end gap-4">
                                            <button wire:click='modalCancelarVenda({{ $item['id'] }})'
                                                class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</button>
                                            <button wire:click='cancelarVenda({{ $item['id'] }})'
                                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                Confirmar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class=" bg-blue-200">
                            <div x-show="showProducts{{ $item->id }}" x-collapse class="overflow-hidden">
                                <div class="px-6 py-3">
                                    <h2 class="font-bold text-gray-700 mb-2 text-sm">Produtos do Pedido</h2>
                                    <table class="min-w-full bg-white rounded-lg overflow-hidden">
                                        <thead class="bg-blue-100">
                                            <tr>
                                                <th
                                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Produto</th>
                                                <th
                                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Quantidade</th>
                                                <th
                                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Preço Unitário</th>

                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach ($item->orderitem as $produtos)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-4 py-2 text-sm text-gray-800">
                                                        {{ $produtos->product->name ?? 'Produto não encontrado' }}
                                                    </td>
                                                    <td class="px-4 py-2 text-sm text-gray-800">
                                                        @if ($produtos->quantity == 0)
                                                            {{ $produtos->snapshot_quantity }}
                                                        @else
                                                            {{ $produtos->quantity }}
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-2 text-sm text-gray-800">
                                                        R$
                                                        {{ number_format($produtos->product->sale_price, 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
        {{ $pedidos->links() }}
    </div>
</div>
