<?php

namespace MaterialIcons;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use BladeUI\Icons\Factory as SvgFactory;

/**
 * Handle the inclusion of an icon stored in a SVG file
 *
 *
 * @uses BladeSvg\SvgFactory
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
        'svg_path' => self::DEFAULT_ICONSET_PATH,
    ];

    /**
     * @var SvgFactory
     */
    private $iconFactory = null;

    /**
     * Instantiate the Iconset factory for a given set of icons
     *
     *
     * @param array $config an associative array that stores the configuration options.
     * @return MaterialIconsBridgeFactory
     */
    public function __construct($config = [])
    {
        $this->config = Collection::make(array_merge($this->config, $config));
    }

    /**
     * Register the blade template engine extension tags
     *
     * @return void
     */
    protected function registerBladeTag()
    {
        Blade::directive('materialicon', function ($expression) {
            return "<?php echo e(materialicon($expression)); ? >";
        });
    }
    
    /**
     * Register iconset in Blade Icons
     *
     * @return void
     */
    protected function registerIconSet()
    {
        return app()->make(SvgFactory::class)->add('materialicons', [
            'path' => $this->config['svg_path'],
            'prefix' => 'materialicons',
        ]);
    }

    /**
     * Boot the package by registering blade tags and the iconset
     */
    public function boot(): self
    {
        $this->iconFactory = $this->registerIconSet();
        $this->registerBladeTag();

        return $this;
    }

    /**
     * Outputs an SVG icon.
     *
     * This method grab the icon whose name is $name and is in the configured path
     *
     * @param string $name The icon name (without the extension)
     * @param string $class The eventual class tag to be applied. Default nothing
     * @param array $attrs Other HTML attributes as an associative array
     * @return \BladeUI\Icons\Svg the SVG to render the icon
     * @deprecated
     */
    public function icon($name, $class = '', $attrs = [])
    {
        if(is_array($class) && empty($attrs)){
            $attrs = $class;
            $class = '';
        }
        $full_class = $attrs['class'] ?? implode(" ", [$this->config['class'], $class]);

        return $this->iconFactory->svg($name, $full_class, $attrs);
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
     * @return \BladeUI\Icons\Svg the SVG to render the icon
     */
    public function materialicon($set, $name, $class = '', $attrs = [])
    {
        $full_class = implode(" ", [$this->config['class'], $class]);

        $prefixed_set = "materialicons-$set";

        $path = sprintf('%s/svg/production/ic_%s_24px', $prefixed_set, $name);

        return $this->iconFactory->svg($path, $full_class, $attrs);
    }

}
