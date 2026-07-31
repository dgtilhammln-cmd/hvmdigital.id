<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'Ilhammaulana'],
            [
                'name'       => 'Ilham Maulana',
                'username'   => 'Ilhammaulana',
                'email'      => 'admin@hvmdigital.id',
                'password'   => Hash::make('Ilhammaulana23'),
                'is_admin'   => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
