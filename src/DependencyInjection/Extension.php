<?php
/**
 * @link https://github.com/phpviet/symfony-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Symfony\NumberToWords\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension as BaseExtension;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class Extension extends BaseExtension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->prepareConfig($configs);
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');
        $definition = $container->getDefinition('n2w');
        $definition->addArgument($config);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias(): string
    {
        return 'n2w';
    }

    /**
     * Thiết lập cấu hình mặc định.
     *
     * @param $configs
     */
    protected function prepareConfig(&$configs): void
    {
        $defaultConfig = [
            'defaults' => [
                'dictionary' => 'standard'
            ],
            'dictionaries' => [
                'standard' => 'n2w_standard_dictionary',
                'south' => 'n2w_south_dictionary'
            ]
        ];

        foreach ($configs as &$config) {
            $config = array_merge($defaultConfig, $config);
        }
    }
}
