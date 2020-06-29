<?php

namespace MaterialIcons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

final class MaterialIconsBridgeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $config = [
            'class' => config('materialiconset.class') ? config('materialiconset.class') : 'icon',
            'icon_path' => config('materialiconset.icon_path') ? base_path(config('materialiconset.icon_path')) : MaterialIconsBridgeFactory::DEFAULT_ICONSET_PATH,
        ];

        app(MaterialIconsBridgeFactory::class)
            ->registerIconsets()
            ->registerBladeTag();

        // dump($this->app->make(Factory::class))->add('heroicons', [
        //     'path' => __DIR__ . '/../resources/svg',
        //     'prefix' => 'heroicon',
        // ]);

        if ($this->app->runningInConsole()) {
            // DEPRECATED
            $this->publishes([
                __DIR__.'/../config/materialiconset.php' => config_path('materialiconset.php'),
            ], 'blade-materialicons');
        }
    }

    public function register()
    {
        $this->app->singleton(MaterialIconsBridgeFactory::class, function () {
            $config = [
                'class' => config('materialiconset.class') ? config('materialiconset.class') : 'icon',
                'icon_path' => config('materialiconset.icon_path') ? base_path(config('materialiconset.icon_path')) : MaterialIconsBridgeFactory::DEFAULT_ICONSET_PATH,
            ];
            return new MaterialIconsBridgeFactory($this->app->make(Factory::class), $config);
        });
    }
}
