<?php
/**
 * @link https://github.com/phpviet/symfony-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Symfony\NumberToWords;

use PHPViet\NumberToWords\Transformer;
use PHPViet\NumberToWords\DictionaryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class Service
{
    /**
     * Container hổ trợ việc lấy các service từ điển.
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Chứa thông tin cấu hình từ dev.
     *
     * @var array
     */
    protected $config;

    /**
     * Khởi tạo dịch vụ chuyển đổi số sang chữ số.
     *
     * @param ContainerInterface $container
     * @param array $config
     */
    public function __construct(ContainerInterface $container, array $config = [])
    {
        $this->container = $container;
        $this->config = $config;
    }

    /**
     * Chuyển đổi số sang chữ số.
     *
     * @param string|int|float $number
     * @param string|null $dictionary
     * @return string
     */
    public function toWords($number, ?string $dictionary = null): string
    {
        $dictionary = $this->getDictionaryInstance($dictionary);
        $transformer = $this->createTransformer($dictionary);

        return $transformer->toWords($number);
    }

    /**
     * Chuyển đổi số sang tiền tệ.
     *
     * @param string|float|int $number
     * @param array|string[]|string $unit
     * @param string|null $dictionary
     * @return string
     */
    public function toCurrency($number, $unit = 'đồng', ?string $dictionary = null): string
    {
        $dictionary = $this->getDictionaryInstance($dictionary);
        $transformer = $this->createTransformer($dictionary);

        return $transformer->toCurrency($number, $unit);
    }

    /**
     * Khởi tạo đối tượng hổ trợ việc chuyển đổi.
     *
     * @param DictionaryInterface|null $dictionary
     * @return Transformer
     */
    protected function createTransformer(?DictionaryInterface $dictionary): Transformer
    {
        return new Transformer($dictionary);
    }

    /**
     * Trả về từ điển dùng để chuyển đổi số sang chữ số.
     *
     * @param string|null $dictionary
     * @return DictionaryInterface|null
     */
    protected function getDictionaryInstance(?string $dictionary): ?DictionaryInterface
    {
        $dictionary = $dictionary ?? $this->getDefaultDictionary();

        if (!$dictionaryService = $this->config['dictionaries'][$dictionary] ?? null) {
            throw new InvalidConfigurationException(sprintf('Dictionary (%s) is not defined!', $dictionary));
        }

        return $this->container->get($dictionaryService);
    }

    /**
     * Trả về từ điển mặc định nếu không chỉ định.
     *
     * @return string
     */
    protected function getDefaultDictionary(): string
    {
        return $this->config['defaults']['dictionary'];
    }

}
