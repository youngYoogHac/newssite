<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $tree = [
            'Технологии' => ['Искусственный интеллект', 'Гаджеты', 'Кибербезопасность'],
            'Программирование' => ['Веб-разработка', 'Мобильная разработка', 'Базы данных'],
            'Наука' => ['Космос', 'Медицина', 'Физика'],
            'Спорт' => ['Футбол', 'Баскетбол', 'Олимпийские игры'],
            'Мир' => ['Политика', 'Происшествия', 'Экология'],
            'Экономика' => ['Финансы', 'Бизнес', 'Криптовалюты'],
        ];

        foreach ($tree as $parentName => $child) {
            $parent = Category::updateOrCreate(
                ['name'=> $parentName],
                ['parent_id' => null]
            );

            foreach ($child as $childName) {
                $child = Category::updateOrCreate(
                    ['name'=> $childName],
                    ['parent_id'=> $parent->id]
                );
            }
        }
    }
}
