@extends('layouts.app')

@section('title', 'Nova Tarefa')

@section('content')
<div class="min-h-screen bg-slate-50/50 font-sans antialiased text-slate-800">

    <main class="max-w-3xl mx-auto px-6 sm:px-8 py-12 space-y-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">
                    Olá, {{ Auth::user()->name ?? 'Usuário' }} 👋
                </h1>
                <p class="text-sm text-slate-500 mt-0.5">Planeje seu dia criando novas demandas.</p>
            </div>
            
            <a href="{{ route('tasks.index') }}" 
               class="inline-flex items-center gap-2 border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition active:scale-[0.98]">
                ← Voltar para a lista
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl flex items-center gap-3 shadow-sm">
                <span class="text-xl">✨</span>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-xl shadow-sm">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xl">⚠️</span>
                    <h4 class="font-bold text-sm text-red-900">Por favor, corrija os erros abaixo:</h4>
                </div>
                <ul class="list-disc list-inside space-y-1 text-sm text-red-700 ml-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            
            <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-base font-bold text-slate-800">Nova Tarefa</h3>
                <p class="text-xs text-slate-400 mt-0.5">Insira as especificações para iniciar o rastreamento.</p>
            </div>

            <form action="{{ route('tasks.store') }}" method="POST" class="p-6 space-y-5">
                @csrf

                <div>
                    <label for="titulo" class="block text-sm font-semibold text-slate-700 mb-1.5">Título da Tarefa</label>
                    <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required placeholder="Ex: Finalizar relatório financeiro"
                           class="w-full text-sm font-medium border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition shadow-sm text-slate-800 p-3 placeholder-slate-400">
                </div>

                <div>
                    <label for="descricao" class="block text-sm font-semibold text-slate-700 mb-1.5">Descrição detalhada</label>
                    <textarea name="descricao" id="descricao" rows="4" placeholder="Adicione observações ou detalhes extras..."
                              class="w-full text-sm font-medium border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition shadow-sm text-slate-800 p-3 placeholder-slate-400">{{ old('descricao') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="prioridade" class="block text-sm font-semibold text-slate-700 mb-1.5">Prioridade</label>
                        <select name="prioridade" id="prioridade" required
                                class="w-full text-sm font-medium border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition shadow-sm text-slate-700 bg-white p-3">
                            <option value="">Selecione o nível</option>
                            <option value="Baixa" {{ old('prioridade') == 'Baixa' ? 'selected' : '' }}>🟢 Baixa</option>
                            <option value="Média" {{ old('prioridade') == 'Média' ? 'selected' : '' }}>🟡 Média</option>
                            <option value="Alta" {{ old('prioridade') == 'Alta' ? 'selected' : '' }}>🔴 Alta</option>
                        </select>
                    </div>

                    <div>
                        <label for="data_entrega" class="block text-sm font-semibold text-slate-700 mb-1.5">Prazo Final</label>
                        <input type="date" name="data_entrega" id="data_entrega" value="{{ old('data_entrega') }}"
                               class="w-full text-sm font-medium border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition shadow-sm text-slate-700 p-3">
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('tasks.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition active:scale-[0.98]">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-indigo-600/10 transition active:scale-[0.98]">
                        Criar Tarefa
                    </button>
                </div>

            </form>
        </div>

    </main>
</div>
@endsection