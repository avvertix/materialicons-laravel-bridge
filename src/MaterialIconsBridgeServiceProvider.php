<?php

namespace MaterialIcons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

final class MaterialIconsBridgeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        app(MaterialIconsBridgeFactory::class)
                ->registerBladeTag();

        if ($this->app->runningInConsole()) {
            /** @deprecated */
            $this->publishes([
                __DIR__.'/../config/materialiconset.php' => config_path('materialiconset.php'),
            ], 'blade-materialicons');
        }
    }

    public function register()
    {
        
        $this->callAfterResolving(Factory::class, function (Factory $factory) {

            $this->app->singleton(MaterialIconsBridgeFactory::class, function () use ($factory) {
                /** @deprecated */
                $config = [
                    'class' => config('materialiconset.class') ? config('materialiconset.class') : 'icon',
                ];
                return new MaterialIconsBridgeFactory($factory, $config);
            });


            app(MaterialIconsBridgeFactory::class)
                ->registerIconsets();
        });
    }
}
