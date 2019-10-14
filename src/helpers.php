<?php

use Illuminate\Support\Str;
use MaterialIcons\MaterialIconsBridgeFactory;

if (! function_exists('icon')) {

    /**
     * Outputs an SVG icon.
     *
     * This method grab the icon whose name is $name and is in the configured path
     *
     * @param string $name The icon name (without the extension)
     * @param string $class The eventual class tag to be applied. Default nothing
     * @param array $attrs Other HTML attributes as an associative array
     * @return string the SVG to render the icon
     */
    function icon($icon, $class = '', $attrs = [])
    {
        return app(MaterialIconsBridgeFactory::class)->icon($icon, $class, $attrs);
    }
}

if (! function_exists('materialicon')) {

    /**
     * Outputs an SVG icon coming from the Material Icons set.
     *
     * This method enables to retrieve an icon from the Google Material Design icon 
     * set
     *
     * @param string $set The icon set (e.g. action)
     * @param string $name The icon name (e.g. alarm)
     * @param string $class The eventual class tag to be applied. Default nothing
     * @param array $attrs Other HTML attributes as an associative array
     * @return string the SVG to render the icon
     */
    function materialicon($set, $icon, $class = '', $attrs = [])
    {
        return app(MaterialIconsBridgeFactory::class)->materialicon($set, $icon, $class, $attrs);
    }
}

if (! function_exists('snake_case')) {

    /**
     * Convert a string to snake case.
     *
     * Alias of Illuminate\Support\Str@snake 
     * 
     * Added to allow nothingworks/blade-svg:0.3.2 which still uses the helper.
     * Once a new version will be released, this helper will go away
     * 
     * @param  string  $value
     * @param  string  $delimiter
     * @return string
     * @internal
     * @deprecated use Illuminate\Support\Str@snake instead
     */
    function snake_case($value, $delimiter = '_')
    {
        return Str::snake($value, $delimiter);
    }
}
