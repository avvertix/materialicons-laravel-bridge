[![Build Status](https://travis-ci.com/avvertix/materialicons-laravel-bridge.svg?branch=master)](https://travis-ci.com/avvertix/materialicons-laravel-bridge)

# Material Icons Laravel Bridge

Easily use Google Material Design SVG icons in Laravel Blade templates.

## Installation

You can install this package via Composer by running this command in your terminal in the root of your project:

```
composer require avvertix/materialicons-laravel-bridge
```

#### For Laravel 5.3 or 5.4 

**use version 0.1 of the library**

Add the Material Iconset service provider to your `config/app.php` file:

```php
<?php

return [
    // ...
    'providers' => [
        // ...

        MaterialIcons\MaterialIconsBridgeServiceProvider::class,

        // ...
    ],
    // ...
];
```

## Configuration

Out of the box the service uses the icons inside the package (under the `assets/icons` folder), but you can 
use [another set of icons](#use-another-icon-set).

By default the class `icon` is added to the icon `svg` tag when inserted into a page. You can change this 
behavior by overriding the configuration using the `config/materialiconset.php` file.

> A ready to use configuration file can be inserted in your config directory using 
> `php artisan vendor:publish --provider="MaterialIcons\MaterialIconsetServiceProvider"`

You can specify any default CSS classes you'd like to be applied to your icons using the `class` option:

```php
<?php

return [
    // ...
    'class' => 'icon', // Add the `icon` class to every SVG icon when rendered
    // ...
];
```

You can specify multiple classes by separating them with a space, just like you would in an HTML class 
attribute

## Basic Usage

To insert an icon in your template, simply use the `@materialicon` Blade directive, passing the name of 
the icon and optionally any additional classes:

```html
<a href="/settings">
    @materialicon('action', 'settings', 'icon-lg') Settings
</a>

<!-- Renders.. -->
<a href="/settings">
    <svg class="icon icon-lg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path d="M19.43 ...(full path omitted for brevity)... 3.5z"/>
    </svg>
    Settings
</a>
```

To add additional attributes to the rendered SVG tag, pass an associative array as the third parameter:

```html
<a href="/settings">
    @materialicon('action', 'settings', 'icon-lg', ['alt' => 'Gear icon']) Settings
</a>

<!-- Renders.. -->
<a href="/settings">
    <svg class="icon icon-lg" alt="Gear icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path d="M19.43 ...(full path omitted for brevity)... 3.5z"/>
    </svg>
    Settings
</a>
```

If you'd like, you can use the `materialicon` helper directly. The helper exposes a fluent syntax for setting icon 
attributes:

```html
<a href="/settings">
    {{ materialicon('actions', 'settings')->alt('Alt text')->dataFoo('bar')->dataBaz() }} Settings
</a>

<!-- Renders.. -->
<a href="/settings">
    <svg class="icon" alt="Alt text" data-foo="bar" data-baz>
        <path d="M19.43 ...(full path omitted for brevity)... 3.5z"/>
    </svg>
    Settings
</a>
```

## Use another icon set

Even if this package makes easy to use Google's Material Design icons, it is not limited to that iconset.

You can still use a different iconset by passing the `icon_path` option in the `config/materialiconset.php`
configuration file. The path refers to the location that contains your individual icons as separate SVG files.

```php
<?php

return [
    // ...
    'icon_path' => 'resources/assets/svg/icons',
    // ...
];
```

> The path is resolved using the `base_path()` helper, so use a relative path to the root of your project.

If you want more freedom (e.g. SVG sprite support) I encourage you to check the 
[Blade SVG](https://github.com/adamwathan/blade-svg) package by Adam Wathan.

## Credits

- The icons comes from the [Google Material Design Icons](https://github.com/google/material-design-icons) 
  package.
- The package functionality is built on top of the great 
  [Blade SVG](https://github.com/adamwathan/blade-svg) package by Adam Wathan

