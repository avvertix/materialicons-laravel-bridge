<?php

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\View;
use BladeUI\Icons\BladeIconsServiceProvider;
use MaterialIcons\MaterialIconsBridgeServiceProvider;

class ComponentsTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            MaterialIconsBridgeServiceProvider::class,
        ];
    }

    public function test_blade_ui_icons_component_is_registered()
    {
        $compiled = $this->renderView('icon');

        $expected = <<<'HTML'
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4V6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"/></svg>
            HTML;

        $this->assertSame($expected, $compiled);
    }


    private function renderView(string $view): string
    {
        return trim(View::file(__DIR__."/resources/views/{$view}.blade.php")->render());
    }
}