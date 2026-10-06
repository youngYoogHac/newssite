<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['title' => 'Первая новость о технологиях', 'content' => 'Краткое описание первой новости.', 'category' => 'Технологии'],
            ['title' => 'Открытие в науке', 'content' => 'Учёные сделали важное открытие.', 'category' => 'Наука'],
            ['title' => 'Победа в спорте', 'content' => 'Наша команда выиграла чемпионат.', 'category' => 'Спорт'],
        ];

        foreach ($items as $item) {
            News::create($item);
        }
    }
}
