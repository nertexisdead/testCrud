<?php

namespace App\Console\Commands;

use App\Jobs\CheckServicesAvailabilityJob;
use App\Jobs\SyncPostsIndexJob;
use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Str;

class SyncPostDataCommand extends Command
{
    protected $signature = 'posts:sync';

    protected $description = 'Sync post data between database, cache, and Elasticsearch';

    public function handle()
    {
        CheckServicesAvailabilityJob::withChain([
            new SyncPostsIndexJob(),
        ])->dispatch();

        $this->info('Post data sync jobs have been dispatched in sequence.');
    }
}
