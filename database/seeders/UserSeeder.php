<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = \App\Models\Role::where('name', 'admin')->first();

        User::updateOrCreate(
            ['login' => 'admin'],
            [
                'name'     => 'Администратор',
                'password' => 'admin123',
                'role_id'  => $adminRole->id,
            ]
        );
    }
}
