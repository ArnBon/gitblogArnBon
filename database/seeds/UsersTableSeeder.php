<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $user = new User;
        $user->name = 'Arnaldo Bonillo';
        $user->email = 'arnaldo@mail.com';
        $user->password = bcrypt('admin1');
        $user->save();

        $user = new User;
        $user->name = 'Yuney Herrera';
        $user->email = 'yuney@mail.com';
        $user->password = bcrypt('admin2');
        $user->save();
    }
}
