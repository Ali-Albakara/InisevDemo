<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create the users and the posts, creating the posts automatically creates the websites
        \App\Models\User::factory(10)->create();
        \App\Models\Post::factory(10)->create();

        // Seed the subscriptions
        for($i = 1; $i <= 10; $i++) {
            \App\Models\Subscription::create([
                'user_id' => $i,
                'website_id' => $i
            ]);
        }
    }
}
