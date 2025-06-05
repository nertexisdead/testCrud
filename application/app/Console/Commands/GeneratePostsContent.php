<?php

namespace App\Console\Commands;

use Faker\Factory;
use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GeneratePostsContent extends Command
{
    protected $signature = 'app:generate-posts-content';

    protected $description = 'Generate random posts content';

    public function handle()
    {
        $filePath = public_path('products_exzap.xlsx');
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getSheet(0);
        $data = $sheet->toArray(null, true, true, true);

        $locales = [
            'ru' => 'B', // колонка B — это name_ru
            'uz' => 'C', // колонка C — это name_uz
        ];

        $fields = ['title', 'content'];

        foreach ($data as $index => $row) {
            if ($index === 1) continue; // пропускаем заголовки

            $post = Post::create([
                'alias' => Str::slug('post-' . $index . '-' . now()->timestamp),
                'is_active' => false,
            ]);

            foreach ($locales as $locale => $column) {
                $faker = Factory::create($locale === 'ru' ? 'ru_RU' : 'en_US');

                foreach ($fields as $field) {
                    $value = $field === 'title'
                        ? $row[$column] ?? '---'
                        : $faker->realText(100);

                    $post->translations()->create([
                        'locale' => $locale,
                        'field' => $field,
                        'value' => $value,
                    ]);
                }
            }
        }

        $this->info("Done: 1000 posts created.");
    }
}
