<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ❌ Esto lo quitamos o comentamos porque da error
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // ✅ Solo dejamos los seeders que sí están listos
        $this->call([
            AdminSeeder::class,
            ClienteSeeder::class,
        ]);
        $this->call(PedidoSeeder::class);

    }
}
