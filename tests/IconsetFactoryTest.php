<?php

use MaterialIcons\IconsetFactory;
use Illuminate\Support\HtmlString;
use Illuminate\Filesystem\Filesystem;

class IconsetFactoryTest extends PHPUnit_Framework_TestCase
{

    // TODO copy the arrow icon before any test and remove it after test completion

    /** @test */
    public function icons_are_given_the_icon_class_by_default()
    {
        $factory = new IconsetFactory();
        $result = $factory->icon('arrow-thick-up')->toHtml();
        $expected = '<svg class="icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function can_render_inline_icon()
    {
        $factory = new IconsetFactory(['inline' => true, 'class' => 'icon', 'icon_path' => __DIR__.'/resources/icons/']);
        $result = $factory->icon('arrow-thick-up')->toHtml();
        $expected = '<svg class="icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function can_render_icon_with_additional_classes()
    {
        $factory = new IconsetFactory();
        $result = $factory->icon('arrow-thick-up', 'icon-lg inline-block')->toHtml();
        $expected = '<svg class="icon icon-lg inline-block" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function can_specify_additional_attributes_as_an_array()
    {
        $factory = new IconsetFactory();
        $result = $factory->icon('arrow-thick-up', 'icon-lg', ['alt' => 'Alt text', 'id' => 'arrow-icon'])->toHtml();
        $expected = '<svg class="icon icon-lg" alt="Alt text" id="arrow-icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function can_skip_class_parameter()
    {
        $factory = new IconsetFactory();
        $result = $factory->icon('arrow-thick-up', ['alt' => 'Alt text', 'id' => 'arrow-icon'])->toHtml();
        $expected = '<svg class="icon" alt="Alt text" id="arrow-icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function attributes_without_keys_are_used_as_valueless_html_attributes()
    {
        $factory = new IconsetFactory();
        $result = $factory->icon('arrow-thick-up', ['alt' => 'Alt text', 'data-foo'])->toHtml();
        $expected = '<svg class="icon" alt="Alt text" data-foo viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_specifying_class_as_attribute_overrides_default_class()
    {
        $factory = new IconsetFactory(['class' => 'default']);
        $result = $factory->icon('arrow-thick-up', ['class' => 'overridden'])->toHtml();
        $expected = '<svg class="overridden" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_if_can_chain_additional_attributes()
    {
        $factory = new IconsetFactory();
        $result = $factory->icon('arrow-thick-up')->alt('Alt text')->id('arrow-icon')->toHtml();
        $expected = '<svg class="icon" alt="Alt text" id="arrow-icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_if_camelcase_attributes_are_dash_cased_when_chaining()
    {
        $factory = new IconsetFactory();
        $result = $factory->icon('arrow-thick-up')->dataFoo('bar')->toHtml();
        $expected = '<svg class="icon" data-foo="bar" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_if_icons_are_cached()
    {
        $svgStub = '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';
        $files = Mockery::spy(Filesystem::class, ['get' => $svgStub]);
        $factory = new IconsetFactory(['inline' => true, 'icon_path' => __DIR__.'/resources/icons/'], $files);

        $resultA = $factory->icon('arrow-thick-up')->toHtml();
        $resultB = $factory->icon('arrow-thick-up')->toHtml();
        $expected = '<svg class="icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10v8h6v-8h5l-8-8-8 8h5z" fill-rule="evenodd"/></svg>';

        $this->assertEquals($expected, $resultA);
        $this->assertEquals($expected, $resultB);
        $files->shouldHaveReceived('get')->once();
    }

    public function test_material_icons_get()
    {
        $factory = new IconsetFactory();
        $result = $factory->materialicon('action', 'accessibility')->toHtml();
        $expected = '<svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg>';
        $this->assertEquals($expected, $result);
    }
}
