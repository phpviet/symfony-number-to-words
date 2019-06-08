<?php
/**
 * @link https://github.com/phpviet/symfony-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Symfony\NumberToWords\Tests;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class ChangeDictionaryTest extends TestCase
{

    public function testTransform(): void
    {
        $kernel = $this->createKernel();
        $kernel->addConfigFile(__DIR__ . '/Resources/change-dictionary-config.yaml');
        $this->bootKernel();
        $service = $this->getContainer()->get('n2w');
        $this->assertEquals('một ngàn', $service->toWords(1000));
    }

}
