<?php

use App\Entities\User;
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
        User::create([
            'name' => 'John Doe',
            'email' => 'user@email.com',
            'avatar' => 'https://randomuser.me/api/portraits/men/6.jpg',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Fern Richards',
            'email' => 'user2@email.com',
            'avatar' => 'https://randomuser.me/api/portraits/men/7.jpg',
            'password' => bcrypt('password'),
        ]);

        factory(User::class, 5)->create();
    }
}
