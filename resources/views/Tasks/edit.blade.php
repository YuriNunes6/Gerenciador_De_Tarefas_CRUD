<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa | TaskFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="max-w-4xl mx-auto py-12 px-4">
        <h1 class="text-2xl font-bold text-gray-700 mb-6">Editar Tarefa</h1>

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="bg-white p-6 rounded-xl shadow-sm border space-y-4">
            @csrf
            @method('PUT')

            <!-- Título -->
            <div>
                <label for="titulo" class="block text-gray-600 font-medium mb-1">Título</label>
                <input type="text" name="titulo" id="titulo" value="{{ $task->name }}" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Descrição -->
            <div>
                <label for="descricao" class="block text-gray-600 font-medium mb-1">Descrição</label>
                <textarea name="descricao" id="descricao" rows="4"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">{{ $task->description }}</textarea>
            </div>

            <!-- Prioridade -->
            <div>
                <label for="prioridade" class="block text-gray-600 font-medium mb-1">Prioridade</label>
                <select name="prioridade" id="prioridade" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="Baixa" {{ $task->prioridade == 'Baixa' ? 'selected' : '' }}>Baixa</option>
                    <option value="Média" {{ $task->prioridade == 'Média' ? 'selected' : '' }}>Média</option>
                    <option value="Alta" {{ $task->prioridade == 'Alta' ? 'selected' : '' }}>Alta</option>
                </select>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-gray-600 font-medium mb-1">Status</label>
                <select name="status" id="status" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="pendente" {{ $task->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="concluida" {{ $task->status == 'concluida' ? 'selected' : '' }}>Concluída</option>
                </select>
            </div>

            <!-- Data de Entrega -->
            <div>
                <label for="data_entrega" class="block text-gray-600 font-medium mb-1">Data de Entrega</label>
                <input type="date" name="data_entrega" id="data_entrega" value="{{ $task->data_entrega }}"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Botões -->
            <div class="flex justify-end gap-3 mt-4">
                <a href="{{ route('tasks.index') }}"
                    class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700">Cancelar</a>
                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-medium">Atualizar</button>
            </div>
        </form>
    </div>

</body>
</html>