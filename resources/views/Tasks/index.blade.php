@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold">
            Olá, {{ Auth::user()->name }} 👋
        </h1>

        <a href="{{ route('tasks.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm">
            + Nova Tarefa
        </a>
    </div>

    <!-- ALERTA -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 text-green-700 p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- CARDS (SÓ SE TIVER TASK) -->
    @if($total > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <p class="text-gray-500 text-sm">Total de Tarefas</p>
            <p class="text-3xl font-bold">{{ $total }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-400">
            <p class="text-gray-500 text-sm">Pendentes</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $pendentes }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-400">
            <p class="text-gray-500 text-sm">Concluídas</p>
            <p class="text-3xl font-bold text-green-600">{{ $concluidas }}</p>
        </div>

    </div>
    @endif

    <!-- MENSAGEM SE NÃO HOUVER TASKS -->
    @if($total == 0)
        <div class="bg-white border border-dashed p-8 text-center text-gray-500 rounded-xl">
            Você ainda não tem tarefas cadastradas 😄 <br><br>
            Clique em <strong>+ Nova Tarefa</strong> para começar.
        </div>
    @endif

    <!-- TABELA -->
    @if($total > 0)
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">

        <table class="w-full text-left">
            <thead class="bg-gray-100 text-gray-500 text-sm uppercase">
                <tr>
                    <th class="p-4">Tarefa</th>
                    <th class="p-4">Prioridade</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Prazo</th>
                    <th class="p-4 text-right">Ações</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($tasks as $task)
                <tr class="hover:bg-gray-50">

                    <!-- TÍTULO -->
                    <td class="p-4">
                        <p class="font-semibold">{{ $task->titulo }}</p>
                        <p class="text-sm text-gray-500">{{ $task->descricao }}</p>
                    </td>

                    <!-- PRIORIDADE -->
                    <td class="p-4">
                        <span class="px-2 py-1 text-xs rounded bg-gray-100">
                            {{ ucfirst($task->prioridade) }}
                        </span>
                    </td>

                    <!-- STATUS -->
                    <td class="p-4">
                        <span class="text-xs px-2 py-1 rounded
                            {{ $task->status == 'pendente' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </td>

                    <!-- DATA -->
                    <td class="p-4 text-gray-500">
                        {{ $task->data_entrega ?? '—' }}
                    </td>

                    <!-- AÇÕES -->
                    <td class="p-4 text-right space-x-2">

                        <a href="{{ route('tasks.edit', $task->id) }}"
                           class="text-indigo-600 hover:underline text-sm">
                            Editar
                        </a>

                        <form action="{{ route('tasks.destroy', $task->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-600 hover:underline text-sm">
                                Excluir
                            </button>
                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-6 text-gray-400">
                        Nenhuma tarefa encontrada
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>
    @endif

</div>
</html>
@endsection