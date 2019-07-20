<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class , 10)->create()->each(function ($user) {
            $user->post()->SaveMany(factory(Post::class , 5)->make());
        });
    }
}
