<?php

namespace Database\Seeders;

use Carbon\Factory;
use App\Models\User;
use App\Models\Reply;
use App\Models\Category;
use App\Models\Question;
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
        \App\Models\User::factory()->count(10)->create();

        \App\Models\Category::factory()->count(5)->create();
        
        \App\Models\Question::factory()->count(10)->create();
        \App\Models\Reply::factory()->count(50)->create()->each(function($reply) {
            $reply->like()->save(\App\Models\Like::factory()->make());
        });
        
        
    }
}
