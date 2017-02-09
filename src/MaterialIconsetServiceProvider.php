<?php

namespace MaterialIcons;

use Illuminate\Support\ServiceProvider;

class MaterialIconsetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app(IconsetFactory::class)->registerBladeTag();

        $this->publishes([
            __DIR__.'/../config/materialiconset.php' => config_path('materialiconset.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton(IconsetFactory::class, function () {
            $config = [
                'class' => config('materialiconset.class') ? config('materialiconset.class') : 'icon',
                'icon_path' => config('materialiconset.icon_path') ? base_path(config('materialiconset.icon_path')) : IconsetFactory::DEFAULT_ICONSET_PATH,
            ];
            return new IconsetFactory($config);
        });
    }
}
