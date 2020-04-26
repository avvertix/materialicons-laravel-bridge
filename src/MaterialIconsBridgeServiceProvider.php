<?php

namespace MaterialIcons;

use Illuminate\Support\ServiceProvider;

class MaterialIconsBridgeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app(MaterialIconsBridgeFactory::class)->boot();

        $this->publishes([
            __DIR__.'/../config/materialiconset.php' => config_path('materialiconset.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton(MaterialIconsBridgeFactory::class, function () {
            $config = [
                'class' => config('materialiconset.class') ? config('materialiconset.class') : 'icon',
                'icon_path' => config('materialiconset.icon_path') ? base_path(config('materialiconset.icon_path')) : MaterialIconsBridgeFactory::DEFAULT_ICONSET_PATH,
            ];
            return new MaterialIconsBridgeFactory($config);
        });
    }
}
