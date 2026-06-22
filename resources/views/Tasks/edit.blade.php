@extends('layouts.app')

@section('title', 'Editar Tarefa')

@section('content')
<div class="min-h-screen bg-slate-50/50 font-sans antialiased text-slate-800">
    
    <main class="max-w-3xl mx-auto px-6 sm:px-8 py-10 space-y-8">
        
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Editar Tarefa</h2>
                <p class="text-sm text-slate-500 mt-0.5">Modifique os detalhes ou atualize o progresso da demanda.</p>
            </div>
            <a href="{{ route('tasks.index') }}" class="inline-flex items-center gap-2 border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition active:scale-[0.98]">
                ← Voltar
            </a>
        </div>

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
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-base font-bold text-slate-900">Atualizar Informações</h3>
                <p class="text-xs text-slate-400 mt-0.5">Altere os campos necessários e clique em salvar.</p>
            </div>

            <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="titulo" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Título da Tarefa</label>
                    <input type="text" name="titulo" id="titulo" value="{{ $task->titulo }}" required
                           class="w-full text-sm font-medium border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition shadow-sm text-slate-800 p-3">
                </div>

                <div>
                    <label for="descricao" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Descrição detalhada</label>
                    <textarea name="descricao" id="descricao" rows="4"
                              class="w-full text-sm font-medium border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition shadow-sm text-slate-800 p-3">{{ $task->descricao }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="prioridade" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Prioridade</label>
                        <select name="prioridade" id="prioridade" required
                                class="w-full text-sm font-medium border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition shadow-sm text-slate-700 bg-white p-3">
                            <option value="Baixa" {{ $task->prioridade == 'Baixa' ? 'selected' : '' }}>🟢 Baixa</option>
                            <option value="Média" {{ $task->prioridade == 'Média' ? 'selected' : '' }}>🟡 Média</option>
                            <option value="Alta" {{ $task->prioridade == 'Alta' ? 'selected' : '' }}>🔴 Alta</option>
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Status Atual</label>
                        <select name="status" id="status" required
                                class="w-full text-sm font-medium border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition shadow-sm text-slate-700 bg-white p-3">
                            <option value="pendente" {{ $task->status == 'pendente' ? 'selected' : '' }}>⏳ Pendente</option>
                            <option value="concluida" {{ $task->status == 'concluida' ? 'selected' : '' }}>✅ Concluída</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="data_entrega" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Prazo Final</label>
                    <input type="date" name="data_entrega" id="data_entrega" value="{{ $task->data_entrega }}"
                           class="w-full text-sm font-medium border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition shadow-sm text-slate-700 p-3">
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('tasks.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition active:scale-[0.98]">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-indigo-600/10 transition active:scale-[0.98]">
                        Atualizar Tarefa
                    </button>
                </div>

            </form>
        </div>

    </main>
</div>
@endsection