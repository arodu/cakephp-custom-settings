# CustomSettings plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require arodu/custom-settings
```

## Configuration

You can load the plugin using the shell command:

```bash
bin/cake plugin load CustomSettings
```

Or you can manually add the loading statement in the `src/Application.php` file of your application:

```php
public function bootstrap(){
    parent::bootstrap();
    //...
    $this->addPlugin(\CustomSettings\Plugin::class);
}
```

Load table database
```bash
bin/cake migrations migrate -p CustomSettings
```

## Usage

```php
use CustomSettings\CustomSettings;

CustomSettings::read(string $name, ?string $category = null): ?EntityInterface;
CustomSettings::write(EntityInterface|array $entity, bool $merge = true): EntityInterface|bool;

CustomSettings::getEntity(array $data): EntityInterface;
CustomSettings::getTypeLabels(): array
```
