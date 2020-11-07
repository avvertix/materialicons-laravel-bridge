
## Upgrade

Ensuring smooth upgrades is hard, that's why this document tries to highlight the major changes.

### General steps

General steps for every update:

- Run `php artisan view:clear`
- Update the referenced version in your `composer.json` file if necessary


### Upgrading from v1.x to v2.0.0

Version 2 relies on `blade-ui-kit/blade-icons`, which is a complete rewrite 
of `nothingworks/blade-svg`.

**Minimum requirements**

The package now requires as a minimum:

- PHP 7.2
- Laravel 7.14

**Config Changes**

Materialicons Laravel bridge do not support anymore changing the icons folder via the 
`svg_path` configuration key. Only icons within `assets/icons` folder.

If you want to add personalized icons migrate to Blade Icons's 
[multiple sets](https://github.com/blade-ui-kit/blade-icons#defining-sets) support.

**Use `materialicon` helper**

The materialicon helper and directive is the preferred approach to insert an
icon in a Blade view. The helper (and directive) takes into account the material icons set 
name and the icon name.

**Removal of `icon` helper**

The `icon` helper has been removed. It was used to pull icons by filename, especially 
when customizing the `svg_path` configuration.

This behavior, to use the exact filename, is part of Blade Icons `svg` helper 
and `@svg` directive. Blade Icons, the library that powers this package, offers also 
Blade components to obtain the same effect.

**Sprite Sheets Removed**

All functionality concerning sprite sheets have been removed. The package didn't really offered sprite sheets, but it was part of `blade-svg` and so we feel that is a breaking change worth mentioning.

**Removal of 48 pixels size variant**

Icons with size of `48px` have been removed because unused and to reduce the package size.
This size was not used as the helpers and directives didn't allow to specify a size option.
