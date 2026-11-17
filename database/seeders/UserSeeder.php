<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Анна Смирнова', 'email' => 'anna@example.com'],
            ['name' => 'Игорь Петров',  'email' => 'igor@example.com'],
            ['name' => 'Мария Иванова', 'email' => 'maria@example.com'],
        ];

        foreach ($users as $data) {
            if (User::where('email', $data['email'])->doesntExist()) {
                User::factory()->create($data); // пароль у всех: password
            }
        }
    }
}
