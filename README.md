![CI](https://github.com/avvertix/materialicons-laravel-bridge/workflows/CI/badge.svg)

# Material Icons Laravel Bridge

Easily use Google Material Design SVG icons in Laravel Blade templates.

For a full list of available icons see the [SVG directories](./assets/icons).


## Requirements

- PHP 7.2 or higher
- Laravel 7.14
- [`blade-ui-kit/blade-icons`](https://github.com/blade-ui-kit/blade-icons)

> Using version `1.x`? Check the [upgrade guide](./UPGRADE.md).

## Installation

You can install this package via Composer by running this command in your terminal in the root of your project:

```bash
composer require avvertix/materialicons-laravel-bridge
```

> The service provider `MaterialIcons\MaterialIconsBridgeServiceProvider::class` 
> is automatically registered as part of the Laravel service discovery

## Configuration

By default the class `icon` is added to the `svg` tag when inserted into a page. 
You can change this behavior by overriding the configuration using 
the `config/materialiconset.php` file.

> A ready to use configuration file can be inserted in your config directory using 
> `php artisan vendor:publish --provider="MaterialIcons\MaterialIconsBridgeServiceProvider"`

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
attribute.

## Usage

### Blade directive

To insert an icon in your template use the `@materialicon` directive, passing the name of 
the material icon set, the name of the icon and optionally any additional classes:

```blade
<a href="/settings">
    @materialicon('action', 'settings', 'icon-lg') Settings
</a>
```

To add additional attributes to the rendered SVG tag, pass an associative array as the third parameter:

```blade
<a href="/settings">
    @materialicon('action', 'settings', 'icon-lg', ['alt' => 'Gear icon']) Settings
</a>
```

If you'd like, you can use the `materialicon` helper directly. The helper exposes a fluent syntax for setting icon 
attributes:

```blade
<a href="/settings">
    {{ materialicon('actions', 'settings')->alt('Alt text')->dataFoo('bar')->dataBaz() }} Settings
</a>
```

### Blade components

All icons are available as Blade components, thanks to [Blade Icons](https://github.com/blade-ui-kit/blade-icons#components)

```blade
<x-materialicon_toggle-ic_star_half_24px />
```

> The component name format is: package name `materialicon`, the set within the package `toggle` 
and the file name `ic_star_half_24px`.

You can also pass classes to your icon components:

```blade
<x-materialicon_toggle-ic_star_half_24px class="icon-lg"/>
```

Or any other attributes for that matter:

```blade
<x-materialicon_toggle-ic_star_half_24px class="icon-lg" id="settings-icon" style="color: #555" data-baz/>
```

### Helper

If you'd like, you can use the `materialicon` helper to expose a fluent syntax for setting SVG attributes:

```blade
{{ materialicon('toggle', 'star_half')->id('star-icon')->dataFoo('bar')->dataBaz() }}
```

## Use another icon set

Even if this package makes easy to use Google's Material Design icons, it is not limited to that iconset.

You can still use a different iconset as behind the scenes the [`blade-ui-kit/blade-icons`](https://github.com/blade-ui-kit/blade-icons) package is used.

Please check [Blade Icon's documentation](https://github.com/blade-ui-kit/blade-icons#configuration) for
all the configuration options and how to insert icons within your Blade views.

## Upgrade

Upgrading from an older version? Check the [upgrade guide](./UPGRADE.md).

## Credits

- The icons comes from the [Google Material Design Icons](https://github.com/google/material-design-icons) 
  package;
- The package functionality was originally created on top of the great Blade SVG package by Adam Wathan now 
  handed to Dries Vints as `blade-ui-kit/blade-icons`.

