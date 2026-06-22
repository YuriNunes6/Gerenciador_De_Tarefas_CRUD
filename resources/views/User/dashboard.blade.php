@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-slate-50/50 font-sans antialiased text-slate-800">
    
    <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-30 px-6 sm:px-8">
        <div class="max-w-7xl mx-auto h-20 flex items-center justify-between gap-4">
            
            <div class="flex items-center gap-3 shrink-0">
                <div class="h-9 w-9 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-md shadow-indigo-200">
                    NS
                </div>
                <span class="text-xl font-black text-slate-900 tracking-tight hidden sm:block">Nome do Sistema</span>
            </div>

            <nav class="flex items-center bg-slate-100/80 p-1 rounded-xl border border-slate-200/30">
                <a href="#" class="px-4 py-2 text-sm font-bold bg-white text-indigo-600 rounded-lg shadow-sm transition-all">
                    📊 Dashboard
                </a>
                <a href="{{ route('tasks.index') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 rounded-lg transition-all">
                    📋 Minhas Tarefas
                </a>
            </nav>
            
            <div class="flex items-center gap-4 shrink-0">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-slate-900">Olá, {{ Auth::user()->name ?? 'Usuário' }} 👋</p>
                    <p class="text-[10px] text-slate-400 font-medium">Conta Ativa</p>
                </div>

                <div class="h-8 w-px bg-slate-200 hidden md:block"></div>

                <a href="{{ route('tasks.create') }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-slate-900/10 hover:shadow-md transition-all active:scale-[0.98]">
                    <span>+</span> <span class="hidden sm:inline">Nova Tarefa</span>
                </a>
            </div>

        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 sm:px-8 py-8 space-y-8">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm flex items-center justify-between group hover:border-slate-300 transition-all">
                <div>
                    <p class="text-sm text-slate-500 font-medium tracking-wide uppercase">Total de Tarefas</p>
                    <p class="text-3xl font-black mt-1.5 text-slate-900">{{ $total }}</p>
                </div>
                <div class="h-12 w-12 bg-slate-100 rounded-xl flex items-center justify-center text-xl text-slate-600 group-hover:scale-110 transition-transform">
                    📁
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm flex items-center justify-between group hover:border-amber-200 transition-all relative overflow-hidden">
                <div class="absolute top-0 left-0 h-1 w-full bg-amber-400"></div>
                <div>
                    <p class="text-sm text-slate-500 font-medium tracking-wide uppercase">Pendentes</p>
                    <p class="text-3xl font-black mt-1.5 text-amber-600">{{ $pendentes }}</p>
                </div>
                <div class="h-12 w-12 bg-amber-50 rounded-xl flex items-center justify-center text-xl text-amber-600 group-hover:scale-110 transition-transform">
                    ⏳
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm flex items-center justify-between group hover:border-emerald-200 transition-all relative overflow-hidden">
                <div class="absolute top-0 left-0 h-1 w-full bg-emerald-400"></div>
                <div>
                    <p class="text-sm text-slate-500 font-medium tracking-wide uppercase">Concluídas</p>
                    <p class="text-3xl font-black mt-1.5 text-emerald-600">{{ $concluidas }}</p>
                </div>
                <div class="h-12 w-12 bg-emerald-50 rounded-xl flex items-center justify-center text-xl text-emerald-600 group-hover:scale-110 transition-transform">
                    ✅
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50/50">
                <div>
                    <h3 class="font-bold text-slate-900 text-lg">Tarefas Recentes</h3>
                    <p class="text-xs text-slate-500">Gerencie e ordene seus fluxos de trabalho atuais.</p>
                </div>
                
                <div class="flex gap-2 w-full sm:w-auto">
                    <form method="GET" action="{{ route('tasks.index') }}" class="w-full sm:w-auto">
                        <select name="ordenar" onchange="this.form.submit()"
                            class="w-full text-sm font-medium border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition shadow-sm text-slate-700 bg-white">
                            <option value="">Ordenar por Status</option>
                            <option value="pendente" {{ request('ordenar') == 'pendente' ? 'selected' : '' }}>
                                ⏳ Pendentes
                            </option>
                            <option value="concluida" {{ request('ordenar') == 'concluida' ? 'selected' : '' }}>
                                ✅ Concluídas
                            </option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50/70 border-b border-slate-100 text-slate-400 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4">Tarefa</th>
                            <th class="px-6 py-4">Prioridade</th>
                            <th class="px-6 py-4">Prazo</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center w-28">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($tasks as $task)
                        <tr class="hover:bg-slate-50/40 transition">
                            <td class="px-6 py-4">
                                <div class="max-w-xs truncate">
                                    <p class="font-semibold text-slate-800 {{ $task->status === 'concluida' ? 'line-through text-slate-400 font-normal' : '' }}">
                                        {{ $task->titulo }}
                                    </p>
                                    <p class="text-slate-400 text-xs truncate font-medium max-w-[220px] mt-0.5">
                                        {{ $task->descricao }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-xl text-xs font-bold inline-flex items-center gap-1.5
                                    @if(strtolower($task->prioridade) == 'alta') bg-red-50 text-red-700 border border-red-100/60
                                    @elseif(strtolower($task->prioridade) == 'media') bg-amber-50 text-amber-700 border border-amber-100/60
                                    @else bg-emerald-50 text-emerald-700 border border-emerald-100/60
                                    @endif
                                ">
                                    <span class="w-1.5 h-1.5 rounded-full 
                                        @if(strtolower($task->prioridade) == 'alta') bg-red-500
                                        @elseif(strtolower($task->prioridade) == 'media') bg-amber-500
                                        @else bg-emerald-500
                                        @endif
                                    "></span>
                                    {{ ucfirst($task->prioridade) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-slate-500 font-medium">
                                <span class="inline-flex items-center gap-1.5 text-xs bg-slate-100 px-2 py-1 rounded-lg text-slate-600 font-semibold">
                                    📅 {{ $task->data_entrega ? \Carbon\Carbon::parse($task->data_entrega)->format('d/m/Y') : 'Sem prazo' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-xs px-2.5 py-1 rounded-xl font-bold border inline-flex items-center
                                    {{ $task->status == 'pendente' ? 'bg-amber-50 text-amber-700 border-amber-200/50' : 'bg-emerald-50 text-emerald-700 border-emerald-200/50' }}">
                                    {{ $task->status == 'pendente' ? '⏳ Pendente' : '✅ Concluído' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('tasks.edit', $task->id) }}" 
                                       class="p-2 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 border border-transparent hover:border-indigo-100 rounded-xl transition shadow-sm bg-white hover:shadow-indigo-100/50" 
                                       title="Editar Tarefa">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')"
                                                class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 border border-transparent hover:border-red-100 rounded-xl transition shadow-sm bg-white hover:shadow-red-100/50" 
                                                title="Excluir Tarefa">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 bg-slate-50/20">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <span class="text-3xl">🎉</span>
                                    <p class="text-sm font-semibold text-slate-800">Tudo limpo por aqui!</p>
                                    <p class="text-xs text-slate-400">Nenhuma tarefa cadastrada ou pendente.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection