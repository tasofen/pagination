
## Install via [composer](https://getcomposer.org/)
```bash
composer require tasofen/allkeys-memcached
```

## Use
```php
require 'vendor/autoload.php';
$pagination = new Tasofen\Pagination();
echo $pagination->getHtml(7, 20); //currentPage, totalPage
```
