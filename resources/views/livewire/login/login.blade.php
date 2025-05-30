<section
    class="min-h-screen flex items-center justify-center bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-200 via-blue-400 to-indigo-600">
    <div class="w-full max-w-3xl max-w-5xl bg-white rounded-xl shadow-2xl flex overflow-hidden h-[600px]">
        <!-- Lado Esquerdo (Imagem) -->
        <div class="w-1/2 flex items-center justify-center">
            <img src="/img/login/dog-login.jpeg" alt="Imagem" class="w-full h-full object-cover object-top">
        </div>
        <!-- Lado Direito (Formulário de Login) -->
        <div class="w-1/2 py-10 px-10 flex flex-col justify-center">
            <i class="fa-solid fa-bone text-[2em] text-blue-500 transform mb-2"></i>
            <h2 class="text-4xl font-bold text-gray-600 mb-2 tracking-wide drop-shadow-md">Bem-vindo<span
                    class="text-blue-500">!</span></h2>
            <p class="text-gray-500 mb-6">Use seu e-mail e senha para acessar sua plataforma de gestão.</p>
            <form wire:submit.prevent="formularioLogin" class="space-y-5">
                <!-- E-mail -->
                <div class="relative">
                    <input type="email" autocomplete="new-email" wire:model="email" placeholder=" "
                        class="peer w-full border border-gray-300 rounded-lg px-4 pt-6 pb-2 shadow focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <label
                        class="absolute left-4 top-2 text-sm text-gray-500 transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
                        E-mail
                    </label>
                    @error('email')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Senha -->
                <div class="relative">
                    <input type="password" autocomplete="new-password" wire:model="password" placeholder=" "
                        class="peer w-full border border-gray-300 rounded-lg px-4 pt-6 pb-2 shadow focus:outline-none focus:ring-2 focus:ring-blue-500 mb-5" />
                    <label
                        class="absolute left-4 top-2 text-sm text-gray-500 transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
                        Senha
                    </label>
                    @error('password')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Botão -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-full font-semibold hover:bg-blue-700 transition">
                    Log In
                </button>
                <!-- Erros de sessão -->
                @if (session()->has('error'))
                    <div class="text-red-600 text-center font-semibold mt-2">
                        {{ session('error') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</section>
