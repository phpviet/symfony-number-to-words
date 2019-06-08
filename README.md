<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/143937" height="100px">
    </a>
    <h1 align="center">Symfony Number To Words</h1>
    <br>
</p>

Symfony number to words hổ trợ chuyển đổi số sang chữ số Tiếng Việt.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/phpviet/symfony-number-to-words.svg?style=flat-square)](https://packagist.org/packages/phpviet/symfony-number-to-words)
[![Build Status](https://img.shields.io/travis/phpviet/symfony-number-to-words/master.svg?style=flat-square)](https://travis-ci.org/phpviet/symfony-number-to-words)
[![Quality Score](https://img.shields.io/scrutinizer/g/phpviet/symfony-number-to-words.svg?style=flat-square)](https://scrutinizer-ci.com/g/phpviet/symfony-number-to-words)
[![StyleCI](https://styleci.io/repos/190297801/shield?branch=master)](https://styleci.io/repos/190297801)
[![Total Downloads](https://img.shields.io/packagist/dt/phpviet/symfony-number-to-words.svg?style=flat-square)](https://packagist.org/packages/phpviet/symfony-number-to-words)

## Cài đặt

+ Cài đặt Symfony Number To Words thông qua [Composer](https://getcomposer.org):

```bash
composer require phpviet/symfony-number-to-words
```

+ Tiếp đến hãy khai báo bundle tại `config/bundles.php`:

```php
// config/bundles.php

return [
    .....
    PHPViet\Symfony\NumberToWords\Bundle::class => ['all' => true]
];
```

## Cách sử dụng

### Các tính năng của extension:

- [`Chuyển đổi số sang chữ số`](#Chuyển-đổi-số-sang-chữ-số)
- [`Chuyển đổi số sang tiền tệ`](#Chuyển-đổi-số-sang-tiền-tệ)
- [`Thay cách đọc số`](#Thay-cách-đọc-số)

### Chuyển đổi số sang chữ số

+ Sử dụng thông service `n2w`:

```php
// âm năm
$container->get('n2w')->toWords(-5); 

// năm
$container->get('n2w')->toWords(5); 

// năm phẩy năm
$container->get('n2w')->toWords(5.5); 
```

+ Sử dụng trong `twig` với `n2w` filter:

```php
// mười lăm
{{ 15 | n2w }}; 

// một trăm linh năm
{{ 105 | n2w }}; 

// hai mươi tư
{{ 24 | n2w }}; 
```

### Chuyển đổi số sang tiền tệ

+ Sử dụng thông qua service `n2w`:

```php
// năm triệu sáu trăm chín mươi nghìn bảy trăm đồng
$container->get('n2w')->toCurrency(5690700);
```

+ Sử dụng trong `twig` với `n2c` filter:

```php
// chín mươi lăm triệu năm trăm nghìn hai trăm đồng
{{ 95500200 | n2c }};
```

Ngoài ra ta còn có thể sử dụng đơn vị tiền tệ khác thông qua tham trị thứ 2 của phương thức
`toCurrency` và filter `n2c` với mảng phần từ đầu tiên là đơn vị cho số nguyên và kế tiếp là đơn vị của phân số:

```php
// sáu nghìn bảy trăm bốn mươi hai đô bảy xen
$container->get('n2w')->toCurrency(6742.7, ['đô', 'xen']);

// chín nghìn bốn trăm chín mươi hai đô mười lăm xen
{{ 9492.15 | n2c(['đô', 'xen']) }};
```

### Thay cách đọc số

> Nếu như bạn cảm thấy cách đọc ở trên ổn rồi thì hãy bỏ qua bước này.

Đầu tiên để thay đổi cách đọc số bạn cần phải tạo file cấu hình `n2w.yaml` trong `config/packages` với nội dung sau:

```yaml
n2w:
    defaults:
        dictionary: 'standard'
    dictionaries:
        standard: 'n2w_standard_dictionary'
        south: 'n2w_south_dictionary'
```

Ngay bây giờ bạn hãy thử đổi default `standard` sang `south`, toàn bộ phương thức chuyển
đổi số sang chữ số và tiền tệ sẽ đọc theo phong cách trong Nam:

```php
// một trăm linh một => một trăm lẻ một
$container->get('n2w')->toWords(101);

// một nghìn => một ngàn
$container->get('n2w')->toWords(1000);

 // hai mươi tư => hai mươi bốn
$container->get('n2w')->toWords(24);

// một trăm hai mươi tư nghìn không trăm linh một đồng => một trăm hai mươi bốn ngàn không trăm lẻ một đồng
$container->get('n2w')->toCurrency(124001);
```

hoặc bạn muốn sử dụng linh động hơn thì hãy chỉ định từ điển:

```php
// một trăm hai mươi tư nghìn không trăm linh một
{{ 124001 | n2w }};

// một trăm hai mươi bốn ngàn không trăm lẻ một
{{ 124001 | n2w('south') }};
```

Nếu như bạn muốn thay đổi cách đọc theo ý bạn thì hãy tạo một lớp `Dictionary` kế thừa
`PHPViet\NumberToWords\Dictionary` hoặc thực thi mẫu trừu tượng `PHPViet\NumberToWords\DictionaryInterface`:

```php
use PHPViet\NumberToWords\Dictionary;
use PHPViet\NumberToWords\Transformer;

class MyDictionary extends Dictionary {

    /**
     * @inheritDoc
     */
    public function specialTripletUnitFive(): string
    {
        return 'nhăm';
    }

}
```

Sau đó đăng ký 1 service cho nó, ví dụ ta sẽ đặt service đại diện cho `MyDictionary` là `app.my` 
tiếp đến khai báo file `n2w.yaml` như sau:

```yaml
n2w:
    defaults:
        dictionary: 'myDictionary'
    dictionaries:
        standard: 'n2w_standard_dictionary'
        south: 'n2w_south_dictionary'
        myDictionary: 'app.my'
```

Và hãy thử ngay:

```php
// mười nhăm
$container->get('n2w')->toWords(15);
```

## Dành cho nhà phát triển

Nếu như bạn cảm thấy extension còn thiếu sót hoặc sai sót và bạn muốn đóng góp để phát triển chung, 
chúng tôi rất hoan nghênh! Hãy tạo các `issue` để đóng góp ý tưởng cho phiên bản kế tiếp 
hoặc tạo `PR` để đóng góp. Cảm ơn!
