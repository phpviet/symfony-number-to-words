<?php
/**
 * @link https://github.com/phpviet/symfony-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Symfony\NumberToWords\Tests;

use Nyholm\BundleTest\BaseBundleTestCase;
use PHPViet\Symfony\NumberToWords\Bundle;
use Nyholm\BundleTest\CompilerPass\PublicServicePass;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class TestCase extends BaseBundleTestCase
{

    protected function setUp(): void
    {
        $this->addCompilerPass(new PublicServicePass());
        $this->bootKernel();
    }


    protected function getBundleClass(): string
    {
        return Bundle::class;
    }

}
