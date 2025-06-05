<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GeneratePostsContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-posts-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate random posts content';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dd(213);
    }
}
