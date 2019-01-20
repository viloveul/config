
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
