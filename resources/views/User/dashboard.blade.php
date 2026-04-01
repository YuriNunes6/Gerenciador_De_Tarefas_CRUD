<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-indigo-600 tracking-tight">TaskFlow</h1>
            </div>
            
            <nav class="flex-1 px-4 space-y-2">
                <a href="#" class="flex items-center p-3 text-indigo-600 bg-indigo-50 rounded-xl font-semibold">
                    Dashboard
                </a>
                <a href="{{ route('tasks.index') }}" class="flex items-center p-3 text-gray-600 hover:bg-gray-100 rounded-xl transition">
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

        <main class="flex-1 overflow-y-auto">
            
            <header class="bg-white border-b border-gray-200 sticky top-0 z-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-700">Olá, {{ Auth::user()->name ?? 'Usuário' }} 👋</h2>
                    
                    <div class="flex items-center gap-4">
                        <a href="{{ route('tasks.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-md">
                            + Nova Tarefa
                        </a>
                    </div>
                </div>
            </header>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                        <p class="text-sm text-gray-500 font-medium">Total de Tarefas</p>
                        <p class="text-3xl font-bold mt-1">{{ $total }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm border-l-4 border-l-yellow-400">
                        <p class="text-sm text-gray-500 font-medium">Pendentes</p>
                        <p class="text-3xl font-bold mt-1 text-yellow-600">{{ $pendentes }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm border-l-4 border-l-green-400">
                        <p class="text-sm text-gray-500 font-medium">Concluídas</p>
                        <p class="text-3xl font-bold mt-1 text-green-600">{{ $concluidas }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700">Tarefas Recentes</h3>
                        <div class="flex gap-2">
                            <form method="GET" action="{{ route('tasks.index') }}">
                                <select name="ordenar" onchange="this.form.submit()"
                                    class="text-sm border-gray-200 rounded-lg focus:ring-indigo-500">

                                    <option value="">Ordenar por Status</option>

                                    <option value="pendente" {{ request('ordenar') == 'pendente' ? 'selected' : '' }}>
                                        Pendentes
                                    </option>

                                    <option value="concluida" {{ request('ordenar') == 'concluida' ? 'selected' : '' }}>
                                        Concluídas
                                    </option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-400 text-xs uppercase tracking-wider">
                                    <th class="px-6 py-4 font-semibold">Tarefa</th>
                                    <th class="px-6 py-4 font-semibold">Prioridade</th>
                                    <th class="px-6 py-4 font-semibold">Prazo</th>
                                    <th class="px-6 py-4 font-semibold">Status</th>
                                    <th class="px-6 py-4 font-semibold text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse($tasks as $task)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <input type="checkbox"
                                                class="h-4 w-4 text-indigo-600 rounded border-gray-300 mr-3"
                                                {{ $task->status === 'concluida' ? 'checked' : '' }}>

                                            <div>
                                                <p class="font-semibold text-gray-800">
                                                    {{ $task->titulo }}
                                                </p>
                                                <p class="text-gray-500 text-xs italic">
                                                    {{ $task->descricao }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium
                                            @if($task->prioridade == 'alta') bg-red-100 text-red-600
                                            @elseif($task->prioridade == 'media') bg-yellow-100 text-yellow-600
                                            @else bg-green-100 text-green-600
                                            @endif
                                        ">
                                            {{ ucfirst($task->prioridade) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-gray-500">
                                        {{ $task->data_entrega ? \Carbon\Carbon::parse($task->data_entrega)->format('d/m/Y') : '-' }}
                                    </td>

                                    <!-- STATUS -->
                                    <td class="px-6 py-4">
                                        <span class="text-xs px-2 py-1 rounded
                                            {{ $task->status == 'pendente' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right space-x-2">
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-gray-400 hover:text-indigo-600">
                                            ✏️
                                        </a>

                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-gray-400 hover:text-red-600">
                                                🗑️
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-gray-400">
                                        Nenhuma tarefa encontrada.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>