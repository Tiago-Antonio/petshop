
<section class="h-screen min-h-full w-screen bg-blue-100">
    <livewire:components.header.header />
    <div class="grid md:grid-rows-5 2xl:grid-rows-3 h-[calc(100vh-4rem)] max-w-6xl mx-auto gap-4 2xl:gap-4 py-4 px-8">
        
        <!-- Primeira linha -->
        <div class="grid gap-2 2xl:gap-4 h-full">
            <div class="h-full grid place-items-center">
                <h1 class=" text-lg 2xl:text-2xl font-bold text-gray-800">{{ $this->usuario_name }}, Bem vindo a sua ferramenta de Gestão</h1>
            </div>
            <div class="h-full grid md:grid-cols-4 gap-4">
                <div class="cursor-pointer shadow-lg hover:shadow-xl transition-allh-full bg-white rounded-3xl grid place-items-center p-1 2xl:p-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                    <a href="{{route('funcionarios')}}" wire:navigate class="grid place-items-center">
                        <div class="flex gap-2 2xl:grid place-items-center">
                            <i class="fas fa-users 2xl:text-4xl 2xl:mb-2"></i>
                            <p class="2xl:text-lg font-medium">Funcionários</p>
                        </div>
                        <p class="text-2xl font-bold">{{$this->usuarios_count}}</p>
                    </a>
                </div>
                
                <div class="cursor-pointer shadow-lg hover:shadow-xl transition-allh-full bg-white rounded-3xl grid place-items-center 2xl:p-4 bg-gradient-to-r from-green-400 to-teal-500 text-white">
                    <a href="{{route('clientes')}}" wire:navigate class="grid place-items-center">
                        <div class="flex gap-2 2xl:grid place-items-center">
                            <i class="fas fa-user-friends 2xl:text-4xl 2xl:mb-2"></i> 
                            <p class="2xl:text-lg font-medium">Clientes</p>
                        </div>
                        <p class="text-2xl font-bold">{{$this->clientes_count}}</p>
                    </a>
                </div>
                <div class="cursor-pointer shadow-lg hover:shadow-xl transition-all h-full bg-white rounded-3xl grid place-items-center 2xl:p-4  bg-gradient-to-r from-yellow-500 to-orange-500 text-white">
                    <a href="{{route('clientes')}}" wire:navigate class="grid place-items-center">
                        <div class="flex gap-2 2xl:grid place-items-center">
                            <i class="fas fa-truck 2xl:text-4xl 2xl:mb-2"></i>
                            <p class="2xl:text-lg font-medium">Fornecedores</p>
                        </div>
                        <p class="text-2xl font-bold">{{$this->suppliers_count}}</p>
                    </a>
                </div>
                <div class="cursor-pointer shadow-lg hover:shadow-xl transition-all h-full bg-white rounded-3xl grid place-items-center 2xl:p-4 bg-gradient-to-r from-pink-500 to-red-500 text-white">
                    <a href="{{route('produtos')}}" wire:navigate class="grid place-items-center">
                        <div class="flex gap-2 2xl:grid place-items-center">
                            <i class="fas fa-box 2xl:text-4xl 2xl:mb-2"></i>
                            <p class="2xl:text-lg font-medium">Produtos</p>
                        </div>
                        <p class="text-2xl font-bold">{{$this->produtos_count}}</p>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Segunda linha -->
        <div class="h-full row-span-2 2xl:row-span-1 grid md:grid-cols-4 gap-4">
            <div class="grid h-full gap-2">
                <div class="h-full shadow-lg bg-white rounded-3xl grid place-items-center p-2 2xl:p-4  bg-gradient-to-r from-cyan-500 to-blue-600 text-white">
                    <i class="fas fa-user-circle text-3xl 2xl:mb-2"></i>
                    <p class="2xl:text-lg">Usuário logado</p>
                    <p class="2xl:text-2xl font-bold">{{ $this->usuario_name }}</p>
                </div>
                <div class="h-full bg-white rounded-3xl grid place-items-center p-2 2xl:p-4 shadow-lg bg-gradient-to-r from-emerald-400 to-green-600 text-white">
                    <i class="fas fa-user-plus text-xl 2xl:text-3xl 2xl:mb-2"></i>
                    <p class="2xl:text-lg font-medium">Clientes Adicionados hoje</p>
                    <p class=" text-xl 2xl:text-3xl font-bold">{{$this->clientes_adicionados_hoje}}</p>
                </div>
            </div>
            <div class="h-full flex-1 md:col-span-3 shadow-md bg-white rounded-3xl 2xl:p-4">
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
        
        <!-- Terceira linha -->
        <div class="h-full row-span-2 2xl:row-span-1  shadow-md bg-white rounded-3xl p-2 2xl:p-4 overflow-auto">
            <h2 class="text-xl font-bold 2xl:mb-4 text-gray-700">Últimos Clientes Adicionados</h2>
            
            <table class="w-full table-auto text-left border-separate border-spacing-y-2">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-gray-600">Nome</th>
                        <th class="px-4 py-2 text-gray-600">Email</th>
                        <th class="px-4 py-2 text-gray-600">Telefone</th>
                        <th class="px-4 py-2 text-gray-600">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ultimos_clientes as $cliente)
                        <tr class="bg-white shadow rounded-xl">
                            <td class="px-4 py-2 text-gray-800">{{ $cliente->name }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $cliente->email }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $cliente->phone }}</td>
                            <td class="px-4 py-2 text-gray-500 text-sm">{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
