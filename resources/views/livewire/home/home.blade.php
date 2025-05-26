<section class="h-screen min-h-full w-screen bg-blue-100 overflow-x-hidden">
    <livewire:components.header.header />
    <div class="grid grid-rows-1 md:grid-rows-5 2xl:grid-rows-3 max-w-screen-xl mx-auto gap-6 py-4 px-4 2xl:px-8">

        <!-- Primeira linha -->
        <div class="grid gap-2 2xl:gap-4 h-full">
            <div class="h-full grid place-items-center">
                <h1 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-gray-800">
                    {{ $this->usuario_name }}, Bem vindo a sua
                    ferramenta de Gestão</h1>
            </div>
            <div class=" grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Funcionarios --}}
                <div
                    class="cursor-pointer shadow-lg hover:shadow-xl transition-all h-full bg-white rounded-3xl grid place-items-center bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                    <a href="{{ route('funcionarios') }}" wire:navigate
                        class="flex flex-col items-center justify-center h-full w-full">
                        <div class="flex flex-col items-center gap-2">
                            <i class="fas fa-users 2xl:text-4xl 2xl:mb-2"></i>
                            <p class="text-sm sm:text-base md:text-lg font-medium">Funcionários</p>
                        </div>
                        <p class="text-xl md:text-2xl font-bold">{{ $this->usuarios_count }}</p>
                    </a>
                </div>

                {{-- Clientes --}}
                <div
                    class="cursor-pointer shadow-lg hover:shadow-xl transition-all h-full bg-white rounded-3xl grid place-items-center bg-gradient-to-r from-green-400 to-teal-500 text-white">
                    <a href="{{ route('clientes') }}" wire:navigate
                        class="flex flex-col items-center justify-center h-full w-full">
                        <div class="flex gap-2 2xl:grid place-items-center">
                            <i class="fas fa-user-friends 2xl:text-4xl 2xl:mb-2"></i>
                            <p class="2xl:text-lg font-medium">Clientes</p>
                        </div>
                        <p class="text-xl md:text-2xl font-bold">{{ $this->clientes_count }}</p>
                    </a>
                </div>

                {{-- Fornecedores --}}
                <div
                    class="cursor-pointer shadow-lg hover:shadow-xl transition-all h-full bg-white rounded-3xl grid place-items-center bg-gradient-to-r from-yellow-500 to-orange-500 text-white">
                    <a href="{{ route('suppliers') }}" wire:navigate
                        class="flex flex-col items-center justify-center h-full w-full">
                        <div class="flex gap-2 2xl:grid place-items-center">
                            <i class="fas fa-truck 2xl:text-4xl 2xl:mb-2"></i>
                            <p class="2xl:text-lg font-medium">Fornecedores</p>
                        </div>
                        <p class="text-xl md:text-2xl font-bold">{{ $this->suppliers_count }}</p>
                    </a>
                </div>

                {{-- Produtos --}}
                <div
                    class="cursor-pointer shadow-lg hover:shadow-xl transition-all h-full bg-white rounded-3xl bg-gradient-to-r from-pink-500 to-red-500 text-white">
                    <a href="{{ route('produtos') }}" wire:navigate
                        class=" h-full w-full flex flex-col items-center justify-center">
                        <div class="flex gap-2 2xl:grid place-items-center">
                            <i class="fas fa-box 2xl:text-4xl 2xl:mb-2"></i>
                            <p class="2xl:text-lg font-medium">Produtos</p>
                        </div>
                        <p class="text-xl md:text-2xl font-bold">{{ $this->produtos_count }}</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Segunda linha -->
        <div class=" grid grid-cols-1 lg:grid-cols-4 gap-4 ">
            <div class="grid md:col-span-1 h-full gap-2">
                <div
                    class="h-full shadow-lg bg-white rounded-3xl grid place-items-center p-2 2xl:p-4  bg-gradient-to-r from-cyan-500 to-blue-600 text-white">
                    <i class="fas fa-user-circle text-3xl 2xl:mb-2"></i>
                    <p class="2xl:text-lg">Pedidos</p>
                    <p class="2xl:text-2xl font-bold">{{ $this->funcionarios_pedidos }}</p>
                </div>
                <div
                    class="h-full bg-white rounded-3xl grid place-items-center p-2 2xl:p-4 shadow-lg bg-gradient-to-r from-emerald-400 to-green-600 text-white">
                    <i class="fas fa-user-plus text-xl 2xl:text-3xl 2xl:mb-2"></i>
                    <p class="2xl:text-lg font-medium">Clientes Adicionados hoje</p>
                    <p class=" text-xl 2xl:text-3xl font-bold">{{ $this->clientes_adicionados_hoje }}</p>
                </div>
            </div>
            <div class="h-full flex-1 md:col-span-3 shadow-lg bg-white rounded-3xl p-4 max-h-64 overflow-auto">
                <p class="text-center text-lg font-semibold text-emerald-600">Produtos abaixo do estoque mínimo</p>

                <div class="mt-4 overflow-x-auto rounded-lg ">
                    <table class="md:min-w-full table-auto text-sm text-left border border-gray-200">
                        <thead class="bg-emerald-100 text-emerald-900">
                            <tr>
                                <th
                                    class="2xl:px-4 py-3 font-semibold md:uppercase md:tracking-wide text-xs md:text-base">
                                    Produto</th>
                                <th
                                    class="2xl:px-4 py-3 font-semibold md:uppercase md:tracking-wide text-xs md:text-base">
                                    Estoque Atual</th>
                                <th
                                    class="2xl:px-4 py-3 font-semibold md:uppercase md:tracking-wide text-xs md:text-base">
                                    Estoque Mínimo</th>
                                <th
                                    class="2xl:px-4 py-3 font-semibold md:uppercase md:tracking-wide text-xs md:text-base">
                                    Atualizado em</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($min_produtos as $produto)
                                <tr class="hover:bg-emerald-50 transition">
                                    <td class="2xl:px-4 py-3 text-gray-800">{{ $produto['name'] }}</td>
                                    <td class="2xl:px-4 py-3 font-medium text-red-600">{{ $produto['current_stock'] }}
                                    </td>
                                    <td class="2xl:px-4 py-3 text-gray-700">{{ $produto['min_stock'] }}</td>
                                    <td class="2xl:px-4 py-3 text-gray-500">
                                        {{ $produto['updated_at']->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-3 text-center text-gray-500">Todos os produtos
                                        estão acima do estoque mínimo!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Terceira linha -->
        <div
            class="hidden md:block h-full  row-span-2 2xl:row-span-1  shadow-md bg-white rounded-3xl p-2 2xl:p-4 overflow-auto">
            <div class="relative h-full">
                <canvas id="myChart" style="width: 100%; height: 100%;"></canvas>
            </div>

            <script>
                const ctx = document.getElementById('myChart').getContext('2d');

                const labels = @json($query_produtos->pluck('name'));
                const data = @json($query_produtos->pluck('current_stock'));
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Estoque Atual',
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
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
</section>
