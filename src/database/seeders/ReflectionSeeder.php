<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Reflection;

class ReflectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // 指定したユーザーを作成
         $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test2@example.com',
            'password' => bcrypt('password'), // パスワード: password
        ]);

        // そのユーザーに紐づく Reflection を 10 件作成
        Reflection::factory()->count(10)->for($user)->create();
    }
}
