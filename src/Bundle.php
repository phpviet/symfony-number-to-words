<?php
/**
 * @link https://github.com/phpviet/symfony-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Symfony\NumberToWords;

use Symfony\Component\HttpKernel\Bundle\Bundle as BaseBundle;
use PHPViet\Symfony\NumberToWords\DependencyInjection\Extension;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class Bundle extends BaseBundle
{
    /**
     * @inheritDoc
     */
    protected $name = 'PHPVietNumberToWordsBundle';

    /**
     * @inheritDoc
     */
    protected function createContainerExtension(): Extension
    {
        return new Extension();
    }

}
