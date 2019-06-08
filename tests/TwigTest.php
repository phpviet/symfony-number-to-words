<?php
/**
 * @link https://github.com/phpviet/symfony-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Symfony\NumberToWords\Tests;

use Symfony\Bundle\TwigBundle\TwigBundle;
use Nyholm\BundleTest\CompilerPass\PublicServicePass;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class TwigTest extends TestCase
{

    protected function setUp(): void
    {
        $this->addCompilerPass(new PublicServicePass());
        $kernel = $this->createKernel();
        $kernel->addBundle(TwigBundle::class);
        $kernel->setProjectDir(__DIR__);
        $kernel->addConfigFile(__DIR__ . '/Resources/twig-config.yaml');
        $this->bootKernel();
    }

    public function testTransformFilter(): void
    {
        $container = $this->getContainer();
        $twig = $container->get('twig');
        $this->assertEquals('một trăm hai mươi ba', trim($twig->render('words.twig')));
    }

    public function testCurrencyTransformFilter(): void
    {
        $container = $this->getContainer();
        $twig = $container->get('twig');
        $this->assertEquals('một trăm hai mươi ba vàng ba bạc', trim($twig->render('currency.twig')));
    }

    public function testChangeDictionary(): void
    {
        $container = $this->getContainer();
        $twig = $container->get('twig');
        $this->assertEquals('một ngàn', trim($twig->render('change-dictionary.twig')));
    }

}
