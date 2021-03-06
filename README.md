
## Install via [composer](https://getcomposer.org/)
```bash
composer require tasofen/pagination
```


## Constructor options
| Name | Type | Default | Description |
| - | - | - | - |
| showPages   | Number  | 11 | Count number links |
| url         | String  | '?page=%s' | URL |
| listTag     | String  | ul | Wrap all links |
| listClass   | String  | pagination | Class for wrap tag |
| itemWrap    | String  | li | Wrap item link |
| itemClass   | String  | page-item waves-effect | Class for wrap item tag |
| linkClass   | String  | page-link | Class for link |
| activeClass | String  | active | Active class |
| first       | Boolean | true | Show link to first page |
| last        | Boolean | true | Show link to last page |
| prev        | Boolean | true | Show link to prev page |
| next        | Boolean | true | Show link to next page |

## Methods
```php
$pagination->getHtml($currentPate, $totalPage);
$pagination->getJSON($currentPate, $totalPage);
$pagination->getArray($currentPate, $totalPage);
```

## Base usage
```php
require 'vendor/autoload.php';
$pagination = new Tasofen\Pagination([
    'showPages' => 5
]);
echo $pagination->getHtml(7, 20); //currentPage, totalPage
```
### Result:
![demo-image](https://github.com/tasofen/pagination/raw/master/demo/demo-1.png)

```html
<ul class="pagination">
  <li class="page-item waves-effect">
    <a href="?page=1" class="page-link">&lt;&lt;</a>
  </li>
  <li class="page-item waves-effect">
    <a href="?page=6" class="page-link">&lt;</a>
  </li>
  <li class="page-item waves-effect">
    <a href="?page=5" class="page-link">5</a>
  </li>
  <li class="page-item waves-effect">
    <a href="?page=6" class="page-link">6</a>
  </li>
  <li class="active page-item waves-effect">
    <a href="?page=7" class="active page-link">7</a>
  </li>
  <li class="page-item waves-effect">
    <a href="?page=8" class="page-link">8</a>
  </li>
  <li class="page-item waves-effect">
    <a href="?page=9" class="page-link">9</a>
  </li>
  <li class="page-item waves-effect">
    <a href="?page=8" class="page-link">&gt;</a>
  </li>
  <li class="page-item waves-effect">
    <a href="?page=20" class="page-link">&gt;&gt;</a>
  </li>
</ul>
```

## Example 1
```php
$pagination = new Tasofen\Pagination([
    'showPages' => 5
]);
for($i=1;$i<=10; $i++) {
    echo '<div>';
    echo $pagination->getHtml($i, 10);
    echo '</div>';
}
```

## Result
![demo-image](https://github.com/tasofen/pagination/raw/master/demo/demo-2.png)


## Example 2
```php
$pagination = new Tasofen\Pagination([
    'showPages' => 3
]);
$list = $pagination->getArray(7, 20); //currentPage, totalPage
print_r($list);
```

### Result
```txt
Array
(
    [0] => Array
        (
            [url] => ?page=1
            [text] => &lt;&lt;
            [active] => false
        )

    [1] => Array
        (
            [url] => ?page=6
            [text] => &lt;
            [active] => false
        )

    [2] => Array
        (
            [url] => ?page=6
            [text] => 6
            [active] => false
        )

    [3] => Array
        (
            [url] => ?page=7
            [text] => 7
            [active] => true
        )

    [4] => Array
        (
            [url] => ?page=8
            [text] => 8
            [active] => false
        )

    [5] => Array
        (
            [url] => ?page=8
            [text] => &gt;
            [active] => false
        )

    [6] => Array
        (
            [url] => ?page=20
            [text] => &gt;&gt;
            [active] => false
        )
)
```

