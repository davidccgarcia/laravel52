<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();

        $post = factory(App\Post::class, 30)->make()->each(function ($post) use ($users) {
            $post->author_id = $users->random()->id;
            $post->save();
        });
    }
}
