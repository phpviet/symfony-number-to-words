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
        $kernel = $this->createKernel();
        $kernel->addBundle(TwigBundle::class);
        $this->addCompilerPass(new PublicServicePass());
        $this->bootKernel();
    }

    public function testFilters()
    {

        $container = $this->getContainer();

        var_dump($container->get('twig')->render(__DIR__ .'/Resources/test.twig'));
        die;
    }

}
