@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-indigo-600 tracking-tight">TaskFlow</h1>
        </div>

        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ route('tasks.index') }}" class="flex items-center p-3 text-indigo-600 bg-indigo-50 rounded-xl font-semibold">
                Minhas Tarefas
            </a>
        </nav>

        <div class="p-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="flex items-center w-full p-3 text-gray-500 hover:text-red-600 transition">
                    Sair
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 overflow-y-auto">
        <header class="bg-white border-b border-gray-200 sticky top-0 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-700">Olá, {{ Auth::user()->name ?? 'Usuário' }} 👋</h2>
                <a href="{{ route('tasks.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-md">
                    Voltar
                </a>
            </div>
        </header>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Mensagem de sucesso -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 text-green-700 p-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Erros de validação -->
            @if ($errors->any())
                <div class="mb-6 bg-red-100 text-red-700 p-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORMULÁRIO -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-xl font-bold mb-4">Nova Tarefa</h3>
                <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Título -->
                    <div>
                        <label for="titulo" class="block text-gray-600 font-medium mb-1">Título</label>
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2">
                    </div>

                    <!-- Descrição -->
                    <div>
                        <label for="descricao" class="block text-gray-600 font-medium mb-1">Descrição</label>
                        <textarea name="descricao" id="descricao" rows="4"
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2">{{ old('descricao') }}</textarea>
                    </div>

                    <!-- Prioridade -->
                    <div>
                        <label for="prioridade" class="block text-gray-600 font-medium mb-1">Prioridade</label>
                        <select name="prioridade" id="prioridade" required
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2">
                            <option value="">Selecione</option>
                            <option value="Baixa" {{ old('prioridade') == 'Baixa' ? 'selected' : '' }}>Baixa</option>
                            <option value="Média" {{ old('prioridade') == 'Média' ? 'selected' : '' }}>Média</option>
                            <option value="Alta" {{ old('prioridade') == 'Alta' ? 'selected' : '' }}>Alta</option>
                        </select>
                    </div>

                    <!-- Data de Entrega -->
                    <div>
                        <label for="data_entrega" class="block text-gray-600 font-medium mb-1">Data de Entrega</label>
                        <input type="date" name="data_entrega" id="data_entrega" value="{{ old('data_entrega') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2">
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition">
                            Criar Tarefa
                        </button>
                        <a href="{{ route('tasks.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </main>

</div>
</html>
@endsection