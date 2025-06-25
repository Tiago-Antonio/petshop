<section class="h-screen min-h-full w-screen bg-blue-100 overflow-x-hidden">
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2" x-init="setTimeout(() => show = false, 5000)"
            class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-50">

            <div
                class="max-w-sm w-full bg-green-50 shadow-lg rounded-lg pointer-events-auto ring-1 ring-green-100 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-green-800">Sucesso!</p>
                            <p class="mt-1 text-sm text-green-600">
                                {{ session('success') }}
                            </p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="show = false" class="...">
                                <!-- Ícone SVG -->
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <livewire:components.header.header />
    <div class="flex flex-col max-w-screen-xl mx-auto gap-6 px-4 2xl:px-8">

        {{-- Primeira linha  --}}
        <div class="grid gap-2 2xl:gap-4 h-full">
            <div class="h-full grid place-items-center py-4">
                <h1 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-gray-800">
                    Olá, seja bem-vindo <span
                        class="text-indigo-600 text-3xl font-bold">{{ $this->usuario_name }}</span>.
                </h1>
            </div>
            <div class=" grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Funcionarios --}}
                <div
                    class="py-4 cursor-pointer shadow-lg hover:shadow-xl transition-all h-full bg-white rounded-2xl grid place-items-center bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                    <a href="{{ route('funcionarios') }}"
                        class="flex flex-col items-center justify-center h-full w-full">
                        <div class="flex flex-col items-center gap-2">
                            <div
                                class=" bg-white/20 p-3 rounded-full group-hover:bg-white/30 transition-colors duration-300">
                                <i class="fas fa-users text-2xl "></i>
                            </div>
                            <p class="text-sm sm:text-base md:text-lg font-medium">Funcionários</p>
                        </div>
                        <p class="text-xl md:text-3xl font-bold">{{ $this->usuarios_count }}</p>
                    </a>
                </div>

                {{-- Clientes --}}
                <div
                    class="py-4 cursor-pointer shadow-lg hover:shadow-xl transition-all h-full bg-white rounded-2xl grid place-items-center bg-gradient-to-r from-green-400 to-teal-500 text-white">
                    <a href="{{ route('clientes') }}" class="flex flex-col items-center justify-center h-full w-full">
                        <div class="flex gap-2 2xl:grid place-items-center">
                            <div
                                class=" bg-white/20 p-3 rounded-full group-hover:bg-white/30 transition-colors duration-300">
                                <i class="fas fa-user-plus text-2xl"></i>
                            </div>
                            <p class="2xl:text-lg font-medium">Clientes</p>
                        </div>
                        <p class="text-xl md:text-3xl font-bold">{{ $this->clientes_count }}</p>
                    </a>
                </div>

                {{-- Fornecedores --}}
                <div
                    class="py-4 cursor-pointer shadow-lg hover:shadow-xl transition-all h-full bg-white rounded-2xl grid place-items-center bg-gradient-to-r from-yellow-500 to-orange-500 text-white">
                    <a href="{{ route('suppliers') }}" class="flex flex-col items-center justify-center h-full w-full">
                        <div class="flex gap-2 2xl:grid place-items-center">
                            <div
                                class=" bg-white/20 p-3 rounded-full group-hover:bg-white/30 transition-colors duration-300">
                                <i class="fas fa-truck text-2xl"></i>
                            </div>
                            <p class="2xl:text-lg font-medium">Fornecedores</p>
                        </div>
                        <p class="text-xl md:text-3xl font-bold">{{ $this->suppliers_count }}</p>
                    </a>
                </div>

                {{-- Produtos --}}
                <div
                    class="py-4 cursor-pointer shadow-lg hover:shadow-xl transition-all h-full bg-white rounded-2xl bg-gradient-to-r from-pink-500 to-red-500 text-white">
                    <a href="{{ route('produtos') }}" wire:navigate
                        class=" h-full w-full flex flex-col items-center justify-center">
                        <div class="flex gap-2 2xl:grid place-items-center">
                            <div
                                class=" bg-white/20 p-3 rounded-full group-hover:bg-white/30 transition-colors duration-300">
                                <i class="fas fa-box text-2xl"></i>
                            </div>
                            <p class="2xl:text-lg font-medium">Produtos</p>
                        </div>
                        <p class="text-xl md:text-3xl font-bold">{{ $this->produtos_count }}</p>
                    </a>
                </div>
            </div>
        </div>

        {{-- Segunda linha  --}}
        <div class=" grid grid-cols-1 lg:grid-cols-4 gap-4 ">
            <div class="grid md:col-span-1 h-full gap-2">
                <div
                    class="h-full shadow-lg bg-white rounded-2xl grid place-items-center p-2 2xl:p-4  bg-gradient-to-r from-cyan-500 to-blue-600 text-white">
                    <a href="{{ route('vendas') }}" class="h-full w-full flex flex-col items-center justify-center">
                        <div
                            class=" bg-white/20 p-3 rounded-full group-hover:bg-white/30 transition-colors duration-300">
                            <i class="fas fa-shopping-cart text-2xl"></i>
                        </div>
                        <p class="2xl:text-lg">Pedidos</p>
                        <p class="2xl:text-2xl font-bold">{{ $this->funcionarios_pedidos }}</p>
                    </a>
                </div>
                <div
                    class="h-full bg-white rounded-2xl grid place-items-center p-2 2xl:p-4 shadow-lg bg-gradient-to-r from-emerald-400 to-green-600 text-white">
                    <div class=" bg-white/20 p-3 rounded-full group-hover:bg-white/30 transition-colors duration-300">
                        <i class="fas fa-user-plus text-2xl"></i>
                    </div>
                    <p class="2xl:text-lg font-medium">Clientes Adicionados hoje</p>
                    <p class=" text-xl 2xl:text-3xl font-bold">{{ $this->clientes_adicionados_hoje }}</p>
                </div>
            </div>
            <div class="h-full flex-1 md:col-span-3 shadow-lg bg-white rounded-3xl p-4 overflow-auto ">
                <p class="text-center text-lg font-semibold text-emerald-600 ">Produtos abaixo do estoque mínimo</p>

                <div class="mt-4 overflow-x-auto rounded-lg ">
                    <table class="md:min-w-full table-auto text-sm text-left border border-gray-200">
                        <thead class="bg-emerald-100 text-emerald-900">
                            <tr>
                                <th
                                    class="2xl:px-4 py-3 font-semibold md:uppercase md:tracking-wide text-xs md:text-base px-2">
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
                                    <td class="2xl:px-4 py-3 text-gray-800 px-2">{{ $produto['name'] }}</td>
                                    <td class="2xl:px-4 py-3 font-medium text-red-600">{{ $produto['current_stock'] }}
                                    </td>
                                    <td class="2xl:px-4 py-3 text-gray-700">{{ $produto['min_stock'] }}</td>
                                    <td class="2xl:px-4 py-3 text-gray-500">
                                        {{ $produto['updated_at']->subHours(3)->format('d/m/Y H:i') }}
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

        {{-- <!-- Terceira linha --> --}}
        <div class="hidden md:block h-64 shadow-md bg-white rounded-3xl p-2 2xl:p-4 overflow-auto">
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
                            x: {
                                ticks: {
                                    callback: function(value, index) {
                                        const label = labels[index];
                                        // Quebra em 10 caracteres ou mantém original
                                        return label.length > 10 ? label.substring(0, 10) + '...' : label;
                                    },
                                    font: {
                                        size: 10
                                    }
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    font: {
                                        size: 12
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    title: function(tooltipItems) {
                                        return labels[tooltipItems[0].dataIndex];
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</section>
