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

    <div class="overflow-x-auto px-4 py-8 max-w-screen-xl mx-auto ">
        <div class="relative w-full md:w-1/2 xl:w-1/4">
            <input type="text" wire:model.live.debounce.100="query" placeholder="Pesquisar"
                class="w-full px-4 py-1 pr-10 rounded-lg border border-gray-300 focus:outline-none">
            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <table class="min-w-full bg-white shadow-md rounded-xl overflow-hidden mt-4">
            <thead class="bg-blue-600 text-white">
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
                <tbody x-data="{ showProducts{{ $item->id }}: false }" wire:key='group-{{ $item->id }}'>
                    <tr class="hover:bg-gray-100 transition-colors duration-200">
                        <td class="px-4 py-4 text-sm text-gray-800">{{ $item['id'] }}</td>
                        <td class="px-4 py-4 text-sm text-gray-800">{{ $item->client->name }}</td>
                        <td class="px-4 py-4 text-sm text-gray-800">{{ $item->user->name }}</td>
                        <td class="px-4 py-4 text-sm text-gray-800">
                            <button type="button"
                                x-on:click="showProducts{{ $item->id }} = !showProducts{{ $item->id }}"
                                class="flex items-center gap-1 bg-blue-500 text-white text-xs font-medium px-3 py-1 rounded hover:bg-blue-600 transition-colors ease-in-out delay-75">
                                <span x-text="showProducts{{ $item->id }} ? '➖ ' : '➕ '"></span> Produtos
                            </button>
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-800">
                            {{ number_format($item['total_amount'], 2, ',', '.') }}</td>
                        <td class="px-4 py-4 text-sm text-gray-800">{{ $item['status'] }}</td>
                        <td class="px-4 py-4 text-sm text-gray-800">{{ $item->created_at->format('d/m/y') }}
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-800">
                            @if ($item->sale)
                                <p>Compra finalizada!</p>
                            @else
                                <div class="flex gap-4">
                                    <button type="button" wire:click='confirmarVenda({{ $item->id }})'
                                        class=" px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded hover:bg-blue-600 transition">
                                        Confirmar
                                    </button>
                                    <button
                                        class=" px-3 py-1 text-sm font-medium text-white bg-red-500 rounded hover:bg-red-600 transition">
                                        Cancelar
                                    </button>
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
                                                        {{ $produtos->quantity }}
                                                    </td>
                                                    <td class="px-4 py-2 text-sm text-gray-800">
                                                        R$
                                                        {{ number_format($produtos->unit_price, 2, ',', '.') }}
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
