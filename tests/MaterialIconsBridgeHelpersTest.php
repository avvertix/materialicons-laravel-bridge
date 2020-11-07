<?php

use BladeUI\Icons\Factory;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Blade;
use BladeUI\Icons\BladeIconsServiceProvider;
use MaterialIcons\MaterialIconsBridgeServiceProvider;

class MaterialIconsBridgeHelpersTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            MaterialIconsBridgeServiceProvider::class,
        ];
    }

    public function test_iconsets_are_registered()
    {
        $sets = app(Factory::class)->all();

        $this->assertNotEmpty($sets);
        $this->assertCount(16, $sets);
    }

    public function test_icons_are_given_the_icon_class_by_default()
    {
        $result = svg('materialicon_toggle-ic_check_box_24px')->toHtml();
        $expected = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2V5c0-1.1-.89-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_specifying_class_as_attribute_overrides_default_class()
    {
        $result = materialicon('action', 'accessibility', '', ['class' => 'overridden'])->toHtml();
        $expected = '<svg class="overridden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_materialicon_helper()
    {
        $result = materialicon('action', 'accessibility')->toHtml();
        $expected = '<svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_can_render_icon_with_additional_classes()
    {
        $result = materialicon('action', 'accessibility', 'icon-lg inline-block')->toHtml();
        $expected = '<svg class="icon icon-lg inline-block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_if_can_chain_additional_attributes()
    {
        $result = materialicon('action', 'accessibility')->alt('Alt text')->id('arrow-icon')->toHtml();
        $expected = '<svg class="icon" alt="Alt text" id="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_if_camelcase_attributes_are_dash_cased_when_chaining()
    {
        $result = materialicon('action', 'accessibility')->dataFoo('bar')->toHtml();
        $expected = '<svg class="icon" data-foo="bar" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg>';
        $this->assertEquals($expected, $result);
    }

    public function test_views_can_render_the_materialicon_directive()
    {
        $compiled = Blade::compileString("@materialicon('action', 'accessibility', 'text-gray-500', ['style' => 'color: #fff'])");

        $expected = "<?php echo e(materialicon('action', 'accessibility', 'text-gray-500', ['style' => 'color: #fff'])); ?>";

        $this->assertSame($expected, $compiled);
    }

}
