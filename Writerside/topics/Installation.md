# Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

## Applications that use Symfony Flex

<primary-label ref="with-flex" />

Open a command console, enter your project directory and execute:

```console
composer require %package_name%
```

## Applications that don't use Symfony Flex

<primary-label ref="with-out-flex" />

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
composer require %package_name%
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Idm\Bundle\Advertising\IdmAdvertisingBundle::class => ['all' => true],
];
```
