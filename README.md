<p align="center"><img src="https://github.com/phluxcp/art/blob/main/logo.svg" alt="Phlux Control Panel logo" title="Phlux"></p>

# phluxcp/operating-system

A PHP framework-agnostic component to detect the running OS name, version and family.

> [!WARNING]
> This package is in early development stage and is not ready for production use. It is not tested yet, so use it at your own risk.

## Installation

```shell
composer require phluxcp/operating-system
```

## Usage

```php
// Instance of Phlux\Component\OperatingSystem\System\SystemInterface
$system = Phlux\Component\OperatingSystem\detect();
```

Each OS instance class can (and should) extend a parent OS class if it is a derivative.

For example, you can detect if the running system is Ubuntu by checking the instance of the class:

```php
use Phlux\Component\OperatingSystem;

$system = OperatingSystem\detect(); // Ubuntu instance
$system instanceof OperatingSystem\System\Ubuntu; // true
```

At the same time, you can check if you are running a Debian based OS, even if it is a derivated OS.

This can be very useful if you want to check between major Linux distributions:

```php

use Phlux\Component\OperatingSystem;

$system = OperatingSystem\detect(); // Ubuntu instance

if ($system instanceof OperatingSystem\System\Debian) {
    // Do something if OS is Debian, Ubuntu, LMDE, Elementary...
} elseif ($system instanceof OperatingSystem\System\Fedora) {
    // Do something if OS is Fedora, RHEL, CentOS...
}
```

## Adding new detectors

If you need to add a new detector for an obscure case, OS, or cannot wait for a pull request to get merged you can add 
more detectors when instantiating the `Detector` class:

```php
use Phlux\Component\OperatingSystem;

// Create a new detector instance with custom detectors...

$detector = new OperatingSystem\Detector(
    new OperatingSystem\Filesystem\Amp(),
    [
        \MyNamespace\OperatingSystem\ObscureOS::class,
        // You can add detectors as you want if they all implements Phlux\Component\OperatingSystem\System\SystemInterface
    ],
);

// ...or add to the default detectors from the constructor...

$detector = new OperatingSystem\Detector(
    new OperatingSystem\Filesystem\Amp(),
    [
        ...OperatingSystem\Detector::DEFAULT_DETECTORS, // Include default detectors
        \MyNamespace\OperatingSystem\ObscureOS::class,
        // You can add detectors as you want if they all implements Phlux\Component\OperatingSystem\System\SystemInterface
    ],
);

// ...or add them later

$detector = new OperatingSystem\Detector(new OperatingSystem\Filesystem\Amp());
$detector->addSystem(\MyNamespace\OperatingSystem\ObscureOS::class);

```

Implement `SystemInterface` if the OS is not a derivated distribution...

```php
use Phlux\Component\OperatingSystem\System\SystemInterface;
 
class ObscureOS implements SystemInterface
{
    // ...
}
```

...or just extend another OS

```php
use Phlux\Component\OperatingSystem\System\Debian;

class ObscureOS extends Debian
{
    // ...
}
```
