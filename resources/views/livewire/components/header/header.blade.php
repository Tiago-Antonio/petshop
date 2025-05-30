<header x-data="{ activePage: '{{ Route::currentRouteName() }}' }" class="bg-white shadow-md w-screen z-50 ">
    <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">
                    <img src="/img/pet-icon.svg" class="h-10 w-10" alt="home">
                </a>
            </div>
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}"
                    :class="{ 'text-blue-600 border-b-2 border-blue-600': activePage === 'home', 'text-gray-600': activePage !== 'home' }"
                    class="hover:text-blue-600 transition font-semibold pb-1">
                    Home
                </a>

                {{-- Só é exibido para os Admin --}}
                @if (auth()->user()->admin == 1)
                    <a href="{{ route('funcionarios') }}"
                        :class="{ 'text-blue-600 border-b-2 border-blue-600': activePage === 'funcionarios', 'text-gray-600': activePage !== 'funcionarios' }"
                        class="hover:text-blue-600 transition font-semibold pb-1">
                        Funcionários
                    </a>
                @endif

                <a href="{{ route('suppliers') }}"
                    :class="{ 'text-blue-600 border-b-2 border-blue-600': activePage === 'suppliers', 'text-gray-600': activePage !== 'suppliers' }"
                    class="hover:text-blue-600 transition font-semibold pb-1">
                    Fornecedores
                </a>

                <a href="{{ route('clientes') }}" wire:navigate
                    :class="{ 'text-blue-600 border-b-2 border-blue-600': activePage === 'clientes', 'text-gray-600': activePage !== 'clientes' }"
                    class="hover:text-blue-600 transition font-semibold pb-1">
                    Clientes
                </a>

                <a href="{{ route('produtos') }}" wire:navigate
                    :class="{ 'text-blue-600 border-b-2 border-blue-600': activePage === 'produtos', 'text-gray-600': activePage !== 'produtos' }"
                    class="hover:text-blue-600 transition font-semibold pb-1">
                    Produtos
                </a>

                <a href="{{ route('vendas') }}" wire:navigate
                    :class="{ 'text-blue-600 border-b-2 border-blue-600': activePage === 'vendas', 'text-gray-600': activePage !== 'vendas' }"
                    class="hover:text-blue-600 transition font-semibold pb-1">Pedidos</a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center text-gray-600 hover:text-red-600 font-semibold">
                        <i class="fas fa-sign-out-alt mr-1"></i> Sair
                    </button>
                </form>
            </nav>
        </div>
    </div>
</header>
