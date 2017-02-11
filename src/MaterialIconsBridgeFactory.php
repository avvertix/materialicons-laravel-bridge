<?php

namespace MaterialIcons;

use Exception;
use BladeSvg\IconFactory;
use BladeSvg\Icon;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Blade;

/**
 * Handle the inclusion of an icon stored in a SVG file
 *
 *
 * @uses BladeSvg\IconFactory
 */
class MaterialIconsBridgeFactory
{

    /**
     * The default path that stores the icons
     *
     * @var string
     */
    const DEFAULT_ICONSET_PATH = __DIR__ . '/../assets/icons';

    /**
     * @var array
     */
    private $config = [
        'class' => 'icon',
        'inline' => true,
        'spritesheet_path' => null,
        'icon_path' => self::DEFAULT_ICONSET_PATH,
    ];

    /**
     * @var IconFactory
     */
    private $iconFactory = null;

    /**
     * Instantiate the Iconset factory for a given set of icons
     *
     *
     * @param array $config an associative array that stores the configuration options.
     * @param Filesystem $filesystem the instance of the filesystem to use. Default null, a default Filesystem instance will be created
     * @return IconsetFactory
     */
    public function __construct($config = [], $filesystem = null)
    {
        $this->config = Collection::make(array_merge($this->config, $config));
        $this->iconFactory = new IconFactory($this->config->toArray(), $filesystem);
    }

    /**
     * Register the blade template engine extension tags
     *
     * @return void
     */
    public function registerBladeTag()
    {
        Blade::directive('icon', function ($expression) {
            return "<?php echo e(icon($expression)); ?>";
        });
        Blade::directive('materialicon', function ($expression) {
            return "<?php echo e(materialicon($expression)); ?>";
        });
    }

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
    public function icon($name, $class = '', $attrs = [])
    {
        return $this->iconFactory->icon($name, $class, $attrs);
    }


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
    public function materialicon($set, $name, $class = '', $attrs = [])
    {
        $path = sprintf('%s/svg/production/ic_%s_24px', $set, $name);

        return $this->iconFactory->icon($path, $class, $attrs);
    }

}
