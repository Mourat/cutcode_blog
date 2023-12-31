<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::factory()->create(['title' => 'Author', 'slug' => 'author']);
        User::factory(rand(3, 8))->create();

        $categories = Category::factory(rand(5, 10))->create();

        Post::factory(rand(10, 20))
            ->create()
            ->each(fn(Post $post) => $post
                ->categories()
                ->sync($categories->random(rand(1, 5)))
            );

        Role::factory()->create(['title' => 'User', 'slug' => 'user']);
        Role::factory()->create(['title' => 'Admin', 'slug' => 'admin']);

        User::factory()->create([
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => Role::query()->where('title', 'Admin')->first()
        ]);
    }
}
