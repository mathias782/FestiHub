<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Alice Johnson',
                'username' => 'alicej',
                'email' => 'alice@example.com',
                'birthday' => '2001-05-10',
                'about' => 'Indie pop lover. Guitar + vocals.',
            ],
            [
                'name' => 'Bob Smith',
                'username' => 'bobsmith',
                'email' => 'bob@example.com',
                'birthday' => '1999-11-22',
                'about' => 'Electronic producer. Keys & synths.',
            ],
            [
                'name' => 'Chloe Brown',
                'username' => 'chloeb',
                'email' => 'chloe@example.com',
                'birthday' => '2002-02-02',
                'about' => 'Jazz enthusiast. Saxophone.',
            ],
            [
                'name' => 'David Lee',
                'username' => 'dlee',
                'email' => 'david@example.com',
                'birthday' => '2000-07-18',
                'about' => 'Rock drummer. Loves live shows.',
            ],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'username' => $u['username'],
                    'birthday' => $u['birthday'],
                    'about' => $u['about'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                    'is_admin' => false,
                ]
            );
        }
    }
}
