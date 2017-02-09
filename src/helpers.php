<?php 

use MaterialIcons\IconsetFactory;

if (! function_exists('icon')) {

    /**
     *
     */
    function icon($icon, $class = '', $attrs = [])
    {
        return app(IconsetFactory::class)->icon($icon, $class, $attrs);
    }
}

if (! function_exists('materialicon')) {

    /**
     *
     */
    function materialicon($set, $icon, $class = '', $attrs = [])
    {
        return app(IconsetFactory::class)->icon($set, $icon, $class, $attrs);
    }
}
