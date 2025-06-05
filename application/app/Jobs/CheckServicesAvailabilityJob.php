<?php

namespace App\Jobs;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CheckServicesAvailabilityJob implements ShouldQueue
{
    use Dispatchable;

    use InteractsWithQueue;

    use Queueable;

    public $tries = 5;

    public $timeout = 60;

    public $backoff = 60;

    public function handle()
    {
        try {
            // Проверяем доступность Elasticsearch
            if (!$this->isElasticsearchAvailable()) {
                Log::warning('Users service: Elasticsearch is not available.');
                throw new \Exception('Users service: Elasticsearch is not available.');
            }
            Log::info('Posts service: Elasticsearch is available.');
        } catch (\Throwable $e) {
            Log::error('Posts service: CheckServicesAvailabilityJob failed: ' . $e->getMessage());
            throw $e; // Повторно выбрасываем исключение для повторной попытки
        }
    }

    private function isElasticsearchAvailable(): bool
    {
        try {
            // Создаем клиент Elasticsearch
            $client = ClientBuilder::create()
                ->setHosts([env('ELASTICSEARCH_HOST')])
                ->build()
            ;

            // Проверяем доступность Elasticsearch через запрос к API
            $response = $client->info();
            return $response->getStatusCode() === 200;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
