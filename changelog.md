# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/0.3.0/) 
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

## [2.1.0] - 2020-12-05

- Allow to specify icon classes as array

## [2.0.1] - 2020-12-05

- Remove fill color defined on some icons in action, av, content, editor and navigation groups

## [2.0.0] - 2020-11-07

- Add support for Laravel 8.x 
- Drop support for Laravel 6.0
- Require `blade-ui-kit/blade-icons` instead of `nothingworks/blade-svg` (_breaking change_)
- Remove `icon` helper (_breaking change_)
- Keep only icons with size of 24px, remove 18px, 36px and 48px variants (_breaking change_)
- Remove support for sprite sheets as consequence of `blade-ui-kit/blade-icons` update (_breaking change_)
- Remove ability to set `svg_path` configuration value (_breaking change_)

## [1.0.1] - 2020-06-29

- Blocked BladeSVG required version to 0.3.4

## [1.0.0] - 2020-03-14

- Add support for Laravel 7.x 
- Drop support for Laravel 5.8 and below
- Drop PHP 7.1 support
- Update minimum requirements for BladeSVG to 0.3.4
- Remove `snake_case` helper (required to support usage of BladeSVG <=0.3.2 in Laravel 6.x)

## [0.4.0] - 2019-10-14

- Add support for Laravel 6.x 
- Drop PHP 7.0 support
- Add `snake_case` helper to support usage of BladeSVG <=0.3.2 in Laravel 6.x. 
  Please note that this helper is for internal use only and 
  will be removed as soon as BladeSVG >0.3.2 will be out

## [0.3.0] - 2019-02-27

- Add support for Laravel 5.7 and 5.8
- Update BladeSVG to 0.3

## [0.2.0] - 2018-06-23

- Add support for Laravel 5.5 and 5.6
- Drop support for Laravel 5.4 or before
- Update BladeSVG to 0.2

## [0.1.0] - 2017-02-11

### Added

- Material design icons version 3.0.1
- Laravel service provider
- Laravel Blade directives
- Unit tests
