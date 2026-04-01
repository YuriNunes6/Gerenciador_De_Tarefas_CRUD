<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | TaskFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

<div class="min-h-screen flex flex-col md:flex-row-reverse">
    
    <div class="hidden md:flex md:w-5/12 bg-indigo-600 p-12 flex-col justify-between text-white relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-8">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <span class="text-2xl font-bold tracking-tight">TaskFlow</span>
            </div>
            <h1 class="text-5xl font-extrabold leading-tight mb-4 text-white">Comece sua jornada hoje.</h1>
            <p class="text-indigo-100 text-lg max-w-sm">Junte-se a milhares de usuários que transformaram seu caos diário em clareza absoluta.</p>
        </div>
    </div>

    <div class="w-full md:w-7/12 flex items-center justify-center p-8 bg-white">
        <div class="w-full max-w-md">
            <div class="mb-10">
                <h2 class="text-3xl font-bold mb-2">Crie sua conta</h2>
                <p class="text-slate-500 font-medium">Leva menos de um minuto para começar.</p>
            </div>

            <!-- Formulário apontando para a rota POST correta -->
            <form action="{{ route('register.submit') }}" method="POST" class="space-y-5">
                @csrf
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Nome</label>
                        <input type="text" id="name" name="name" required 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all placeholder-slate-400" 
                            placeholder="João">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">E-mail</label>
                    <input type="email" id="email" name="email" required 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all placeholder-slate-400" 
                        placeholder="seu@email.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">Senha</label>
                    <input type="password" id="password" name="password" required 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all placeholder-slate-400" 
                        placeholder="Mínimo 8 caracteres">
                    <p class="mt-2 text-xs text-slate-400 italic font-medium tracking-tight">Dica: Use letras, números e símbolos.</p>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1">Confirme a senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all placeholder-slate-400" 
                        placeholder="Repita a senha">
                </div>

                <div class="flex items-start">
                    <input type="checkbox" id="terms" name="terms" required class="mt-1 w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                    <label for="terms" class="ml-2 text-sm text-slate-600 leading-tight">
                        Eu aceito os <a href="#" class="text-indigo-600 font-bold hover:underline">Termos de Serviço</a> e a <a href="#" class="text-indigo-600 font-bold hover:underline">Política de Privacidade</a>.
                    </label>
                </div>

                <button type="submit" 
                    class="w-full bg-slate-900 hover:bg-black text-white font-bold py-4 rounded-xl transition-all shadow-xl hover:shadow-indigo-100 active:scale-[0.98] mt-2">
                    Criar minha conta gratuita
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-slate-600 text-sm font-medium">
                    Já possui uma conta no TaskFlow? 
                    <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline ml-1">Fazer Login</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Script opcional para mostrar erros de validação -->
@if ($errors->any())
    <div class="fixed bottom-4 right-4 bg-red-500 text-white p-4 rounded-lg shadow-lg">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</body>
</html>