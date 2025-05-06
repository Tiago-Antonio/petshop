<header x-data="{ show: false }" class="bg-white shadow-md w-full z-50 ">
    <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex-shrink-0">

                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">
                    <img src="/img/pet-icon.svg" class="h-10 w-10" alt="home">
                </a>
            </div>
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition">Home</a>
                <a href="{{ route('funcionarios') }}" class="text-gray-600 hover:text-blue-600 transition">Funcionários</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center text-gray-600 hover:text-red-600">
                        <i class="fas fa-sign-out-alt mr-1"></i> Sair
                    </button>
                </form> 

            </nav>
        </div>
    </div>
</header>
