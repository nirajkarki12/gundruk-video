<?php

namespace App\Channel\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use App\Channel\Interfaces\ChannelInterface;
use App\Channel\Repository\ChannelRepository;
class ChannelServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Channel', 'database/migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->singleton(ChannelInterface::class,ChannelRepository::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Channel', 'Config/config.php') => config_path('channel.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Channel', 'Config/config.php'), 'channel'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/channel');

        $sourcePath = module_path('Channel', 'resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/channel';
        }, \Config::get('view.paths')), [$sourcePath]), 'channel');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/channel');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'channel');
        } else {
            $this->loadTranslationsFrom(module_path('Channel', 'resources/lang'), 'channel');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Channel', 'database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
