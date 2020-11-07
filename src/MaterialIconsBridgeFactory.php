<?php

namespace MaterialIcons;

use BladeUI\Icons\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;

/**
 * Handle the inclusion of an icon stored in a SVG file
 *
 *
 * @uses BladeUI\Icons\Factory
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

    private $subsets = [
        'action',
        'alert',
        'av',
        'communication',
        'content',
        'device',
        'editor',
        'file',
        'hardware',
        'image',
        'maps',
        'navigation',
        'notification',
        'places',
        'social',
        'toggle',
    ];

    /**
     * @var \BladeUI\Icons\Factory
     */
    private $iconFactory = null;

    /**
     * Instantiate the Iconset factory for a given set of icons
     *
     * @param \BladeUI\Icons\Factory $bladeSvgFactory The Blade UI Icons factory instance.
     * @param array $config an associative array that stores the configuration options.
     * @return MaterialIconsBridgeFactory
     */
    public function __construct(Factory $bladeSvgFactory, $config = [])
    {
        $this->iconFactory = $bladeSvgFactory;
        $this->config = Collection::make($this->config)->merge(Arr::only($config, 'class'));
    }

    /**
     * Register the blade extension directives
     *
     * @return self
     */
    public function registerBladeTag(): self
    {
        Blade::directive('materialicon', function ($expression) {
            return "<?php echo e(materialicon($expression)); ?>";
        });

        return $this;
    }
    
    /**
     * Register iconset in Blade UI Kit
     *
     * @return self
     */
    public function registerIconSets(): self
    {
        foreach ($this->subsets as $subset) {
            $this->iconFactory->add("materialicons_$subset", [
                'path' => $this->config['svg_path'] . "/$subset/svg/production",
                'prefix' => "materialicon_$subset",
            ]);
        }

        return $this;
    }

    /**
     * Outputs an SVG icon coming from the Material Icons set.
     *
     * This method enables to retrieve an icon from the Google Material Design icon 
     * set
     *
     * @param string $set The icon set within Material UI icons (e.g. action)
     * @param string $name The icon name (e.g. alarm)
     * @param string $class The eventual class tag to be applied. Default nothing
     * @param array $attrs Other HTML attributes as an associative array
     * @return \BladeUI\Icons\Svg the SVG to render the icon
     */
    public function materialicon($set, $name, $class = '', $attrs = [])
    {
        $full_class = implode(" ", [$this->config['class'], $class]);

        $prefixed_set = "materialicon_$set";

        $icon = sprintf('%s-ic_%s_24px', $prefixed_set, $name);

        return $this->iconFactory->svg($icon, $full_class, $attrs);
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
     * @deprecated Use Blade UI Icons directives and helpers https://github.com/blade-ui-kit/blade-icons#directive. Will be removed in version 2.0
     */
    public function icon($name, $class = '', $attrs = [])
    {
        if(is_array($class) && empty($attrs)){
            $attrs = $class;
            $class = '';
        }
        $full_class = $attrs['class'] ?? implode(" ", [$this->config['class'], $class]);

        $icon = "materialicon_$name";

        return $this->iconFactory->svg($icon, $full_class, $attrs);
    }

}
