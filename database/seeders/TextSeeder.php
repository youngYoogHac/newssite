<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Text;
use App\Models\User;
use Illuminate\Database\Seeder;

class TextSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->where('login', 'admin')->first();
        if (! $admin) {
            $this->command->warn('Нет админа — пропускаем TextSeeder.');
            return;
        }

        // Получаем категории по имени
        $categories = Category::query()->pluck('id', 'name');

        $items = [
            [
                'heading'     => 'Первая новость о технологиях',
                'text'        => 'Краткое описание первой новости.',
                'category_id' => $categories['Технологии'] ?? null,
            ],
            [
                'heading'     => 'Открытие в науке',
                'text'        => 'Учёные сделали важное открытие.',
                'category_id' => $categories['Наука'] ?? null,
            ],
            [
                'heading'     => 'Победа в спорте',
                'text'        => 'Наша команда выиграла чемпионат.',
                'category_id' => $categories['Спорт'] ?? null,
            ],
        ];

        foreach ($items as $item) {
            if (! $item['category_id']) {
                continue; // пропускаем, если категории нет
            }

            Text::updateOrCreate(
                ['heading' => $item['heading']],
                array_merge($item, ['user_id' => $admin->id])
            );
        }
    }
}