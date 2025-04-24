<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Psr\Http\Client\ClientInterface;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;
use GuzzleHttp\Client as ClientHTTP;
use Laravel\Scout\EngineManager;
use Matchish\ScoutElasticSearch\Engines\ElasticSearchEngine;
use Matchish\ScoutElasticSearch\ElasticSearch\HitsIteratorAggregate;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind Guzzle as PSR-18 HTTP client
        $this->app->bind(ClientInterface::class, function () {
            return new GuzzleAdapter(new ClientHTTP());
        });

        // Bind Elasticsearch Client
        $this->app->bind(Client::class, function () {
            return ClientBuilder::create()
                ->setHosts([config('scout.elasticsearch.config.hosts')[0]]) // ou ton host custom
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        resolve(EngineManager::class)->extend('elasticsearch', function ($app) {
            return app(ElasticSearchEngine::class);
        });
    }
}
