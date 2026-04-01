<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Base da query (sempre do usuário logado)
        $query = Task::where('user_id', Auth::id());

        // Ordenação por status
        if ($request->filled('ordenar')) {
            $status = $request->ordenar;

            $query->orderByRaw("
                CASE 
                    WHEN status = ? THEN 0
                    ELSE 1
                END
            ", [$status]);
        } else {
            $query->latest();
        }

        $tasks = $query->get();

        // Cards (melhor prática: separado da listagem)
        $total = Task::where('user_id', Auth::id())->count();

        $pendentes = Task::where('user_id', Auth::id())
            ->where('status', 'pendente')
            ->count();

        $concluidas = Task::where('user_id', Auth::id())
            ->where('status', 'concluida')
            ->count();

        return view('user.dashboard', compact('tasks', 'total', 'pendentes', 'concluidas'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prioridade' => 'required|string',
            'data_entrega' => 'nullable|date',
        ]);

        Task::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'status' => 'pendente',
            'prioridade' => $request->prioridade,
            'data_entrega' => $request->data_entrega,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Tarefa criada com sucesso!');
    }

    public function show(string $id)
    {
        $task = Task::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

        return view('tasks.show', compact('task'));
    }

    public function edit(string $id)
    {
        $task = Task::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, string $id)
    {
        $task = Task::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prioridade' => 'required|string',
            'status' => 'required|string',
            'data_entrega' => 'nullable|date',
        ]);

        $task->update([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'prioridade' => $request->prioridade,
            'status' => $request->status,
            'data_entrega' => $request->data_entrega,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada!');
    }

    public function dashboard()
    {
        $tasks = Task::where('user_id', Auth::id())
        ->latest()
        ->take(5) // tarefas recentes
        ->get();

        $total = Task::where('user_id', Auth::id())->count();
        $pendentes = Task::where('user_id', Auth::id())
        ->where('status', 'pendente')
        ->count();

        $concluidas = Task::where('user_id', Auth::id())
        ->where('status', 'concluida')
        ->count();

        return view('user.dashboard', compact('tasks', 'total', 'pendentes', 'concluidas'));
    }

    public function destroy(string $id)
    {
        $task = Task::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Tarefa excluída!');
    }
}