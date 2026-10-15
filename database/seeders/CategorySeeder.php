<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Технологии',
            'Программирование',
            'Наука',
            'Спорт',
            'Мир',
            'Экономика',
        ];

        foreach ($names as $name) {
            Category::updateOrCreate(['name' => $name]);
        }
    }
}
