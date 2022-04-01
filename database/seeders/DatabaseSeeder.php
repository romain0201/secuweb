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
        \App\Models\Article::factory(15)->create();

        $user = new \App\Models\User;
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = md5('admin');
        $user->save();

        $user = new \App\Models\User;
        $user->name = 'editor';
        $user->email = 'editor@gmail.com';
        $user->password = md5('editor');
        $user->save();
    }
}
