<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Str;

class GeneratePostsContent extends Command
{
    protected $signature = 'app:generate-posts-content';

    protected $description = 'Generate random posts content';

    public function handle()
    {
        $locales = config('app.availables_locales', ['ru', 'en']);
        $fields = ['title', 'content'];

        $this->info("Starting creation of 1000 posts...");

        for ($i = 0; $i < 200; $i++) {
            $post = Post::create([
                'alias' => Str::slug('post-' . $i . '-' . now()->timestamp),
            ]);

            foreach ($locales as $locale) {
                foreach ($fields as $field) {
                    $faker = \Faker\Factory::create($locale === 'ru' ? 'ru_RU' : 'en_US');

                    $value = $field === 'title'
                        ? $faker->realText(10)
                        : $faker->realText(100);

                    $post->translations()->create([
                        'locale' => $locale,
                        'field' => $field,
                        'value' => $value,
                        'is_active' => true,
                    ]);
                }
            }

            if ($i % 100 === 0) {
                $this->info("Created $i posts...");
            }
        }

        $this->info("Done: 1000 posts created.");
    }
}
