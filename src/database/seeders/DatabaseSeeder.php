<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    User::create([
        'name' => 'メル',
        'email' => 'test123@example.com',
        'password' => bcrypt('test1234'),
    ]);

    User::create([
        'name' => 'メル2',
        'email' => 'test456@example.com',
        'password' => bcrypt('test4567'),
    ]);

    User::factory(3)->create();

    $this->call(ItemSeeder::class);
    $this->call(MessageSeeder::class);
    }
}
