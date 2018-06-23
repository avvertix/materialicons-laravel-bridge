<?php

use PHPUnit\Framework\TestCase;
use Illuminate\Support\HtmlString;
use Illuminate\Filesystem\Filesystem;
use MaterialIcons\MaterialIconsBridgeFactory;

class MaterialIconsBridgeHelpersTest extends TestCase
{
    const ARROW_SVG_TEST_FILE = __DIR__ . '/resources/icons/arrow-thick-up.svg';
    
    const ICONS_LOCATION = __DIR__ . '/../assets/icons/';


    /**
     * @beforeClass
     */
    public static function setUpSomeSharedFixtures()
    {
        if (! function_exists('app')) 
        {
            function app(){
                return new MaterialIconsBridgeFactory();
            }
        }
    }


    protected function setUp()
    {
        copy(self::ARROW_SVG_TEST_FILE, self::ICONS_LOCATION . basename(self::ARROW_SVG_TEST_FILE));
    }
    
    protected function tearDown()
    {
        $path = self::ICONS_LOCATION . basename(self::ARROW_SVG_TEST_FILE);

        if(is_file($path))
        {
            unlink($path);
        }
    }

    public function test_icon_helper()
    {
        $result = icon('arrow-thick-up')->toHtml();
        $expected = '<svg class="icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_materialicon_helper()
    {
        $result = materialicon('action', 'accessibility')->toHtml();
        $expected = '<svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg>';
        $this->assertEquals($expected, $result);
    }
}
