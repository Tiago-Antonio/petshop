
<section class="h-screen w-screen bg-blue-100">
    <livewire:components.header.header />
    <div class="grid grid-rows-3 h-[calc(100vh-4rem)] max-w-6xl mx-auto gap-4 py-4 px-8">
        
        <!-- Primeira linha -->
        <div class="grid gap-4 h-full">
            <div class="h-full grid place-items-center">
                <h1 class=" text-xl font-semibold">Nome, Bem vindo a sua ferramenta de Gestão</h1>
            </div>
            <div class="h-full grid grid-cols-4 gap-4">
                <div class="shadow-md h-full bg-white rounded-3xl grid place-items-center p-4">1</div>
                <div class="shadow-md h-full bg-white rounded-3xl grid place-items-center p-4">2</div>
                <div class="shadow-md h-full bg-white rounded-3xl grid place-items-center p-4">3</div>
                <div class="shadow-md h-full bg-white rounded-3xl grid place-items-center p-4">4</div>
            </div>
        </div>
        
        <!-- Segunda linha -->
        <div class="h-full flex gap-4">
            <div class="grid h-full gap-4">
                <div class="h-full shadow-md bg-white rounded-3xl grid place-items-center p-4">novos clientes</div>
                <div class="h-full shadow-md bg-white rounded-3xl grid place-items-center p-4">Invoices overdue</div>
            </div>
            <div class="h-full flex-1 shadow-md bg-white rounded-3xl p-4">gráfico</div>
        </div>
        
        <!-- Terceira linha -->
        <div class="h-full shadow-md bg-white rounded-3xl p-4">
            <table class="w-full h-full">
                <tr><td>últimos adicionados</td></tr>
            </table>
        </div>
    </div>
</section>
