<?php
/**
 * @link https://github.com/phpviet/symfony-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Symfony\NumberToWords\Twig\Extension;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;
use PHPViet\Symfony\NumberToWords\Service;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class N2WExtension extends AbstractExtension
{

    /**
     * Phone number helper.
     *
     * @var Service
     */
    protected $service;

    /**
     * Khởi tạo extension
     *
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('n2w', [$this->service, 'toWords']),
            new TwigFilter('n2c', [$this->service, 'toCurrency']),
        ];
    }

}
