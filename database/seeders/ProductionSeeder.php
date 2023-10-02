<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::factory()->create(['title' => 'User', 'slug' => 'user']);
        Role::factory()->create(['title' => 'Author', 'slug' => 'author']);
        Role::factory()->create(['title' => 'Admin', 'slug' => 'admin']);

        User::factory()->create([
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => Role::query()->where('title', 'Admin')->first()
        ]);
    }
}
