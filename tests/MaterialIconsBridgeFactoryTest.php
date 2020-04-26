<?php

use PHPUnit\Framework\TestCase;
use Illuminate\Support\HtmlString;
use Illuminate\Filesystem\Filesystem;
use MaterialIcons\MaterialIconsBridgeFactory;


class MaterialIconsBridgeFactoryTest extends TestCase
{
    const ARROW_SVG_TEST_FILE = __DIR__ . '/resources/icons/arrow-thick-up.svg';
    
    const ICONS_LOCATION = __DIR__ . '/../assets/icons/';

    protected function setUp(): void
    {
        copy(self::ARROW_SVG_TEST_FILE, self::ICONS_LOCATION . basename(self::ARROW_SVG_TEST_FILE));
    }
    
    protected function tearDown(): void
    {
        $path = self::ICONS_LOCATION . basename(self::ARROW_SVG_TEST_FILE);

        if(is_file($path))
        {
            unlink($path);
        }
    }

    public function test_icons_are_given_the_icon_class_by_default()
    {
        $factory = (new MaterialIconsBridgeFactory())->boot();
        $result = $factory->icon('materialicons-arrow-thick-up')->toHtml();
        $expected = '<svg class="icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_can_render_inline_icon()
    {
        $factory = (new MaterialIconsBridgeFactory(['class' => 'icon', 'icon_path' => __DIR__.'/resources/icons/']))->boot();
        $result = $factory->icon('materialicons-arrow-thick-up')->toHtml();
        $expected = '<svg class="icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_can_render_icon_with_additional_classes()
    {
        $factory = (new MaterialIconsBridgeFactory())->boot();
        $result = $factory->icon('materialicons-arrow-thick-up', 'icon-lg inline-block')->toHtml();
        $expected = '<svg class="icon icon-lg inline-block" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_can_specify_additional_attributes_as_an_array()
    {
        $factory = (new MaterialIconsBridgeFactory())->boot();
        $result = $factory->icon('materialicons-arrow-thick-up', 'icon-lg', ['alt' => 'Alt text', 'id' => 'arrow-icon'])->toHtml();
        $expected = '<svg alt="Alt text" id="arrow-icon" class="icon icon-lg" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_can_skip_class_parameter()
    {
        $factory = (new MaterialIconsBridgeFactory())->boot();
        $result = $factory->icon('materialicons-arrow-thick-up', ['alt' => 'Alt text', 'id' => 'arrow-icon'])->toHtml();
        $expected = '<svg alt="Alt text" id="arrow-icon" class="icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_attributes_without_keys_are_used_as_valueless_html_attributes()
    {
        $factory = (new MaterialIconsBridgeFactory())->boot();
        $result = $factory->icon('materialicons-arrow-thick-up', ['alt' => 'Alt text', 'data-foo'])->toHtml();
        $expected = '<svg alt="Alt text" data-foo class="icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_specifying_class_as_attribute_overrides_default_class()
    {
        $factory = (new MaterialIconsBridgeFactory(['class' => 'default']))->boot();
        $result = $factory->icon('materialicons-arrow-thick-up', ['class' => 'overridden'])->toHtml();
        $expected = '<svg class="overridden" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_if_can_chain_additional_attributes()
    {
        $factory = (new MaterialIconsBridgeFactory())->boot();
        $result = $factory->icon('materialicons-arrow-thick-up')->alt('Alt text')->id('arrow-icon')->toHtml();
        $expected = '<svg class="icon" alt="Alt text" id="arrow-icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_if_camelcase_attributes_are_dash_cased_when_chaining()
    {
        $factory = (new MaterialIconsBridgeFactory())->boot();
        $result = $factory->icon('materialicons-arrow-thick-up')->dataFoo('bar')->toHtml();
        $expected = '<svg class="icon" data-foo="bar" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_material_icons_get()
    {
        $factory = (new MaterialIconsBridgeFactory())->boot();
        $result = $factory->materialicon('action', 'accessibility')->toHtml();
        $expected = '<svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg>';
        $this->assertEquals($expected, $result);
    }
}
