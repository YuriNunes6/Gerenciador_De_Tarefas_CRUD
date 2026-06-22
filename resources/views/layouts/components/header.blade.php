<header class="bg-slate-950/95 backdrop-blur-md border-b border-slate-800 sticky top-0 z-50 px-6 sm:px-8">
    <nav class="max-w-7xl mx-auto h-16 flex items-center justify-between gap-4">
        
        <div class="flex items-center shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                <div class="h-8 w-8 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-black text-sm shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-all">
                    NS
                </div>
                <h1 class="text-lg font-black text-white tracking-tight group-hover:text-slate-200 transition-colors">
                    Nome do Sistema
                </h1>
            </a>
        </div>

        <div class="flex items-center gap-6">
            @auth

                <div class="h-5 w-px bg-slate-800 hidden sm:block"></div>

                <div class="flex items-center gap-3">
                    <span class="text-xs font-medium text-slate-400 hidden md:block">
                        {{ Auth::user()->name }}
                    </span>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="bg-red-500/10 hover:bg-red-600 text-red-400 hover:text-white border border-red-500/20 px-3 py-1.5 rounded-xl text-xs font-bold transition-all active:scale-[0.98]">
                            Sair
                        </button>
                    </form>
                </div>
            @else
                <ul class="flex items-center gap-3">
                    <li>
                        <a href="{{ route('login') }}" 
                           class="text-xs font-bold text-slate-400 hover:text-white px-3 py-2 rounded-xl transition-all">
                            Entrar
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" 
                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-xs font-bold shadow-sm shadow-indigo-600/10 transition-all active:scale-[0.98]">
                            Cadastrar-se
                        </a>
                    </li>
                </ul>
            @endauth
        </div>
    </nav>
</header>