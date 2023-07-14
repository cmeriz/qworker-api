<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->wishlist_items()->create([
                'title' => fake()->sentence(3),
                'description' => fake()->paragraph(),
                'image_path' => '/600x400/png',
                'user_id' => $user->id,
            ]);
        }
    }
}
