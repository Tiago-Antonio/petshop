<section class="flex h-screen">
    <div class="h-full w-1/2  relative ">
        <img src="/img/login/dog-login.jpg" alt="Dog Login" class=" object-contain object-bottom absolute bottom-0 left-0 w-full h-full  ">
    </div>
    <div class="grid place-items-center w-full bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-300 via-white to-white">
        <form wire:submit.prevent='formularioLogin' class=" max-w-md space-y-4">
            <h1 class="text-4xl font-bold text-center">Bem vindo de volta!</h1>
            <h2 class="text-xl font-medium text-gray-500 text-center">Gerencie seu PetShop com eficiência, carinho e dedicação.</h2>
        
            <!-- E-mail -->
            <div class="relative w-full">
                <input wire:model='email' type="email" autocomplete="new-email" placeholder=" " class="peer w-full border border-gray-300 shadow-md rounded-lg px-4 pt-6 pb-2 focus:outline-none " />
                <label  class="absolute left-4 top-2 text-sm text-gray-500 transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
                    E-mail
                </label>
                @error('email') 
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        
            <!-- Senha -->
            <div class="relative w-full">
                <input wire:model='password' type="password" placeholder=" " autocomplete="new-password"  class="peer w-full border border-gray-300 shadow-md rounded-lg px-4 pt-6 pb-2 focus:outline-none  " />
                <label class="absolute left-4 top-2 text-sm text-gray-500 transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
                    Senha
                </label>
                @error('password') 
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            

            <button class="w-full h-11 rounded-lg bg-blue-600 text-white font-semibold shadow-md hover:bg-blue-700 hover:shadow-lg hover:text-white transition duration-300 ease-in-out">
                Log In
            </button>
            
            @if (session()->has('error'))
                <div class="text-red-600 text-center font-semibold">
                    {{ session('error') }}
                </div>
            @endif
        </form>
    </div>
</section>
