<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'adminurban-guard@yahoo.fr'],
            [
                'name' => 'Super Administrateur',
                'password' => Hash::make('0123456789'),
                'role' => 'admin',
            ]
        );
    }
}
