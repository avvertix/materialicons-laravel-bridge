<?php

use Orchestra\Testbench\TestCase;
use Illuminate\Support\HtmlString;
use Illuminate\Filesystem\Filesystem;
use MaterialIcons\MaterialIconsBridgeFactory;
use BladeUI\Icons\BladeIconsServiceProvider;
use MaterialIcons\MaterialIconsBridgeServiceProvider;

class MaterialIconsBridgeHelpersTest extends TestCase
{
    const ARROW_SVG_TEST_FILE = __DIR__ . '/resources/icons/arrow-thick-up.svg';
    
    const ICONS_LOCATION = __DIR__ . '/../assets/icons/';

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            MaterialIconsBridgeServiceProvider::class,
        ];
    }

    public function test_icon_can_be_found()
    {
        $result = materialicon('action', 'accessibility')->toHtml();
        $expected = '<svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg>';
        $this->assertEquals($expected, $result);
    }
}
