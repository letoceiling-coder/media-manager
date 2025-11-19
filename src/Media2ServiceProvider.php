<?php

namespace LetoceilingCoder\MediaManager;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class MediaManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Публикуем ресурсы
        $this->publishes([
            __DIR__ . '/../resources/js' => resource_path('js/vendor/media2'),
        ], 'media2-assets');

        // Публикуем конфигурацию
        $this->publishes([
            __DIR__ . '/../config/media2.php' => config_path('media2.php'),
        ], 'media2-config');

        // Публикуем миграции
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'media2-migrations');
        
        // Загружаем конфигурацию
        $this->mergeConfigFrom(
            __DIR__ . '/../config/media2.php',
            'media2'
        );

        // Регистрируем роуты (без токенов и middleware)
        $this->loadRoutes();
    }

    /**
     * Загрузить роуты API
     */
    protected function loadRoutes(): void
    {
        $apiBaseUrl = config('media2.api_base_url', '/api/v1');
        
        Route::middleware('api')
            ->prefix($apiBaseUrl)
            ->group(function () {
                require __DIR__ . '/Routes/media-api.php';
            });
    }
}

