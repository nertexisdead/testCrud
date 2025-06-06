<?php

namespace App\Components\Helpers;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Illuminate\Support\Facades\Log;

class Elasticsearch
{
    protected Client $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts([env('ELASTICSEARCH_HOST')])
            ->setBasicAuthentication(env('ELASTICSEARCH_USERNAME'), env('ELASTICSEARCH_PASSWORD'))
            ->build()
        ;
    }

    public function createIndex(string $indexName, array $synonyms): void
    {
        $this->createIndexWithMapping($indexName, $synonyms);
    }

    public function createIndexWithMapping(string $indexName, array $synonyms): void
    {
        Log::info("Creating index {$indexName} with mapping");

        $params = [
            'index' => $indexName,
            'body' => [
                'settings' => [
                    'analysis' => [
                        'filter' => [
                            'synonym_filter' => [
                                'type' => 'synonym',
                                'synonyms' => $synonyms,
                            ],
                        ],
                        'analyzer' => [
                            'synonym_analyzer' => [
                                'tokenizer' => 'standard',
                                'filter' => [
                                    'lowercase',
                                    'synonym_filter',
                                ],
                            ],
                        ],
                    ],
                ],
                'mappings' => [
                    'properties' => [
                        'id' => ['type' => 'integer'],
                        'alias' => ['type' => 'keyword'],
                        'title' => [
                            'properties' => [
                                'ru' => [
                                    'type' => 'text',
                                    'analyzer' => 'synonym_analyzer',
                                ],
                                'uz' => [
                                    'type' => 'text',
                                    'analyzer' => 'synonym_analyzer',
                                ],
                            ],
                        ],
                        'translations' => [
                            'type' => 'nested',
                            'properties' => [
                                'name' => [
                                    'type' => 'text',
                                    'analyzer' => 'synonym_analyzer',
                                ],
                                'locale' => ['type' => 'keyword'],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->client->indices()->create($params);

        Log::info("Index {$indexName} created with mapping successfully.");
    }

    public function ensureIndexExists(string $indexName, array $synonyms): void
    {
        try {
            $this
                ->client
                ->indices()
                ->get(['index' => $indexName])
            ;
        } catch (ClientResponseException $e) {
            if ($e->getCode() === 404) {
                $this->createIndex($indexName, $synonyms);
            } else {
                throw $e;
            }
        }
    }

    public function indexDocument(string $indexName, $id, array $document): void
    {
        try {
            $this->client->index([
                'index' => $indexName,
                'id' => $id,
                'body' => $document,
            ]);
            Log::info("Document {$id} indexed in {$indexName}");
        } catch (\Exception $e) {
            Log::error("Failed to index document {$id} in {$indexName}: " . $e->getMessage());
        }
    }

    public function deleteAllIndices(): void
    {
        try {
            // Удаляем все индексы с помощью wildcard '*'
            $this->client->indices()->delete(['index' => 'posts']);
            Log::info('All indices have been deleted.');
        } catch (\Exception $e) {
            Log::error('Failed to delete indices: ' . $e->getMessage());
        }
    }
}
