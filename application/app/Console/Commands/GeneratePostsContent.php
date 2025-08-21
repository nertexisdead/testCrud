<?php

namespace App\Console\Commands;

use Faker\Factory;
use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Str;

class GeneratePostsContent extends Command
{
    protected $signature = 'app:generate-posts-content {count=1000}';

    protected $description = 'Generate random posts content';

    public function handle()
    {
        $count = (int) $this->argument('count');

        $locales = [
            'ru' => 'ru_RU',
            'uz' => 'en_US',
        ];

        $fields = ['title', 'content'];

        for ($i = 1; $i <= $count; $i++) {
            $post = Post::create([
                'alias' => Str::slug('post-' . $i . '-' . now()->timestamp),
                'is_active' => false,
            ]);

            foreach ($locales as $locale => $fakerLocale) {
                $faker = Factory::create($fakerLocale);

                foreach ($fields as $field) {
                    $value = $field === 'title'
                        ? $faker->sentence(6)
                        : $faker->realText(200);

                    $post->translations()->create([
                        'locale' => $locale,
                        'field'  => $field,
                        'value'  => $value,
                    ]);
                }
            }
        }

        $this->info("Done: {$count} posts created.");
    }
}
