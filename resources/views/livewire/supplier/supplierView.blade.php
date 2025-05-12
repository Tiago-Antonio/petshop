<section class="h-screen w-screen bg-blue-100">
    <livewire:components.header.header />
    <div class="grid grid-rows-[auto_1fr] h-[calc(100vh-4rem)] max-w-6xl mx-auto gap-4 py-4 px-8">
        <!-- Primeira linha -->
        <div class="grid gap-2 2xl:gap-4 h-full">
            <div class="flex justify-between items-center">
                <!-- Campo de pesquisa -->
                <input type="text" class="w-1/3 px-4 py-2 rounded-lg shadow-md text-gray-800" placeholder="Pesquisar fornecedores..." />
                
                <!-- Botão Adicionar -->
                <button class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition-all">Adicionar Fornecedor</button>
                <button
                wire:click="deleteSelected"
                class="px-6 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 transition-all"
                @disabled(!is_array($selectedSuppliers) || count($selectedSuppliers) === 0)
                >Deletar Selecionados
                </button>
            
                <div class=" col-span-4 flex justify-between">
                    <button wire:click="previousPage" class="px-4 py-2 bg-gray-300 rounded-md mr-2"><i class="fa-solid fa-arrow-left"></i></button>
                    <button wire:click="nextPage" class="px-4 py-2 bg-gray-300 rounded-md"><i class="fa-solid fa-arrow-right"></i></button>
                </div>

            </div>
        </div>

        <!-- Segunda linha -->
        <div class="h-full row-span-2 2x4:row-span-1 grid grid-cols-1 gap-4 overflow-auto">
            <div class="overflow-x-auto bg-white shadow-lg rounded-3xl p-4">
                <table class="min-w-full table-auto text-left border-separate border-spacing-y-2">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-gray-600"><i class="fa-regular fa-square-check"></i></th>
                            <th class="px-4 py-2 text-gray-600">Nome</th>
                            <th class="px-4 py-2 text-gray-600">E-mail</th>
                            <th class="px-4 py-2 text-gray-600">Telefone</th>
                            <th class="px-4 py-2 text-gray-600">Endereço</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!--TESTE DO BODY DA TABLE-->
                    @foreach ($suppliers as $item)
                        <tr class="bg-white shadow rounded-xl">
                            <td class="px-4 py-2 text-gray-800">
                                <form action="#">
                                    <input type="checkbox" id="checkBox" name="checkBoxFornecedor" value="check">
                                </form>
                            </td>
                            <td class="px-4 py-2 text-gray-800">{{$item['name']}}</td>
                            <td class="px-4 py-2 text-gray-800">{{$item['email']}}</td>
                            <td class="px-4 py-2 text-gray-800">{{$item['phone']}}</td>
                            <td class="px-4 py-2 text-gray-500 text-sm">{{$item['address']}}</td>
                        </tr>
                    @endforeach
                    <!--TESTE DO BODY DA TABLE-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
