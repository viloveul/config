<p align="center">
<a href="https://travis-ci.com/viloveul/config">
<img src="https://travis-ci.com/viloveul/config.svg" alt="Build Status">
</a>
<a href="https://packagist.org/packages/viloveul/config">
<img src="https://poser.pugx.org/viloveul/config/d/total.svg" alt="Total Downloads">
</a>
<a href="https://packagist.org/packages/viloveul/config">
<img src="https://poser.pugx.org/viloveul/config/v/stable.svg" alt="Latest Stable Version">
</a>
</p>

# Installation

make sure your php version > 7.0

```bash
composer require viloveul/config
```

## HOW

```php
require __DIR__ . '/vendor/autoload.php';

$config = new Viloveul\Config\Configuration([
	'key' => 'value'
]);
$config->setFoo('bar');
$config->bar = 'baz';
$config['main'] = 'item';

$otherConfig = Viloveul\Config\ConfigFactory::load('/path/to/your/config/file.php');

$anotherConfig = new Viloveul\Config\Configuration([
	'hello' => 'world'
]);

$otherAnotherConfig = new Viloveul\Config\Configuration([
	'key' => 'dor'
]);

$anotherOtherAnotherConfig = new Viloveul\Config\Configuration([
	'foo' => 'ssstttt'
]);

$config->merge($otherConfig);
$config->merge($anotherConfig);
$config->merge($anotherConfig, false);
$config->merge($anotherOtherAnotherConfig, true);

var_dump($config->all());
```
