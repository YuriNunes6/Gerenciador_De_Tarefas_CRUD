<header>
    <nav class="flex items-center justify-between bg-[#000000] px-6 py-4 text-white">
        <!-- Logo / Marca -->
        <div class="flex items-center space-x-3">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <h1 class="text-xl font-bold">FlowTask</h1>
            </a>
        </div>

        <!-- Links de Navegação -->
        <ul class="flex space-x-6 items-center">
            @auth
                <li><a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a></li>
                <li><a href="{{ route('tasks.index') }}" class="hover:underline">Minhas Tarefas</a></li>

                <!-- Logout -->
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">Sair</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="hover:underline">Login</a></li>
                <li><a href="{{ route('register') }}" class="hover:underline">Cadastro</a></li>
            @endauth
        </ul>
    </nav>
</header>