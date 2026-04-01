<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TaskFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <div class="min-h-screen flex flex-col md:flex-row">
        
        <div class="hidden md:flex md:w-1/2 bg-indigo-600 p-12 flex-col justify-between text-white relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-8">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight">TaskFlow</span>
                </div>
                <h1 class="text-5xl font-extrabold leading-tight mb-4">Gerencie sua rotina <br> de forma inteligente.</h1>
                <p class="text-indigo-100 text-lg max-w-md">Onde a produtividade encontra a simplicidade. Organize suas tarefas e conquiste seus objetivos diários.</p>
            </div>

            <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
            <div class="absolute top-1/2 -right-20 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>

            <div class="relative z-10">
                <p class="text-sm text-indigo-200">© 2026 TaskFlow Inc. Todos os direitos reservados.</p>
            </div>
        </div>

        <div class="w-full md:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <div class="mb-10">
                    <h2 class="text-3xl font-bold mb-2">Bem-vindo de volta</h2>
                    <p class="text-slate-500">Insira suas credenciais para acessar sua conta.</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">E-mail</label>
                        <input type="email" id="email" name="email" required 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all" 
                            placeholder="seu@email.com">
                    </div>

                    <div>
                        <div class="flex justify-between mb-1">
                            <label for="password" class="text-sm font-medium text-slate-700">Senha</label>
                            <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">Esqueceu a senha?</a>
                        </div>
                        <input type="password" id="password" name="password" required 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all" 
                            placeholder="••••••••">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                        <label for="remember" class="ml-2 text-sm text-slate-600 font-medium">Lembrar por 30 dias</label>
                    </div>

                    <button type="submit" 
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition-all shadow-lg shadow-indigo-200 active:scale-[0.98]">
                        Entrar na plataforma
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-slate-100">
                    <p class="text-center text-slate-600 text-sm">
                        Não tem uma conta? 
                        <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">Criar conta gratuita</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>