<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Criar usuário primeiro
        $user = User::create([
            'name' => 'Teste User',
            'email' => 'teste@teste.com',
            'password' => Hash::make('123456'),
        ]);

        // Tasks
        Task::create([
            'titulo' => 'Estudar Laravel',
            'descricao' => 'Revisar controllers, rotas e migrations',
            'status' => 'pendente',
            'prioridade' => 'alta',
            'data_entrega' => now()->addDays(3),
            'user_id' => $user->id,
        ]);

        Task::create([
            'titulo' => 'Fazer layout do dashboard',
            'descricao' => 'Melhorar UI com Tailwind',
            'status' => 'concluida',
            'prioridade' => 'media',
            'data_entrega' => now()->addDays(1),
            'user_id' => $user->id,
        ]);

        Task::create([
            'titulo' => 'Corrigir bugs do CRUD',
            'descricao' => 'Ajustar validações e edição',
            'status' => 'pendente',
            'prioridade' => 'baixa',
            'data_entrega' => now()->addDays(5),
            'user_id' => $user->id,
        ]);
    }
}