<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            [
                'name' => 'Super Admin in da house',
                'email' => 'superadmin@gmail.com',
                'idManager' => 'xx',
                'password' => bcrypt('123'),
                'foto' => '/img/user.jpg',
                'level' => 3
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'idManager' => 'xx',
                'password' => bcrypt('123'),
                'foto' => '/img/user.jpg',
                'level' => 1
            ],
            [
                'name' => 'Administrator2',
                'email' => 'admin2@gmail.com',
                'idManager' => 'xx',
                'password' => bcrypt('123'),
                'foto' => '/img/user.jpg',
                'level' => 1
            ],
            [
                'name' => 'Kasir 1',
                'email' => 'kasir1@gmail.com',
                'idManager' => 'xx',
                'password' => bcrypt('123'),
                'foto' => '/img/user.jpg',
                'level' => 2
            ]
        );

        array_map(function (array $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }, $users);
    }
}
