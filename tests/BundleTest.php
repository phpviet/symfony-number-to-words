<?php
/**
 * @link https://github.com/phpviet/symfony-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Symfony\NumberToWords\Tests;

use PHPViet\Symfony\NumberToWords\Service;
use PHPViet\NumberToWords\DictionaryInterface;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class BundleTest extends TestCase
{
    public function testBundle(): void
    {
        $container = $this->getContainer();
        $this->assertTrue($container->has('n2w'));
        $this->assertTrue($container->has('n2w_standard_dictionary'));
        $this->assertTrue($container->has('n2w_south_dictionary'));
        $this->assertTrue($container->has(DictionaryInterface::class));
        $service = $container->get('n2w');
        $this->assertInstanceOf(Service::class, $service);
    }
}
