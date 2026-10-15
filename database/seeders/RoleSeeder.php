<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['user', 'journalist', 'admin'] as $name) {
            Role::updateOrCreate(['name'=> $name]);
        }
    }
}
