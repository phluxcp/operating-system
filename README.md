# phluxcp/operating-system

A PHP framework-agnostic component to detect the running OS name, version and family.

> [!WARNING]
> This package is in early development stage and is not ready for production use. It is not tested yet, so use it at your own risk.

## Installation

```shell
composer require phluxcp/operating-system
```

## Usage

Start a new `Detector` instance and get the running OS

```php
use Phlux\Component\OperatingSystem\Detector;

$detector = new Detector();

$system = $detector->getSystem(); // Instance of Phlux\Component\OperatingSystem\System\SystemInterface
```

Each OS instance class can (and should) extend a parent OS class if it is a derivative.

For example, you can detect if the running system is Ubuntu by checking the instance of the class:

```php
use Phlux\Component\OperatingSystem\Detector;
use Phlux\Component\OperatingSystem\System\Ubuntu;

$detector = new Detector();

$system = $detector->getSystem(); // Ubuntu instance
$system instanceof Ubuntu; // true
```

At the same time, you can check if you are running a Debian based OS, even if it is a derivated OS.

This can be very useful if you want to check between major Linux distributions:

```php
use Phlux\Component\OperatingSystem\Detector;
use Phlux\Component\OperatingSystem\System\Debian;
use Phlux\Component\OperatingSystem\System\Fedora;

$detector = new Detector();
$system = $detector->getSystem();

if ($system instanceof Debian) {
    // Do something if OS is Debian, Ubuntu, LMDE, Elementary...
} elseif ($system instanceof Fedora) {
    // Do something if OS is Fedora, RHEL, CentOS...
}
```

Another way to detect the operating system is to instantiate directly the OS class:
```php
use Phlux\Component\OperatingSystem\System\Ubuntu;

$ubuntu = new Ubuntu();

if ($ubuntu->isRunningOS()){
    // Do something if running Ubuntu	
}
```

## Adding new detectors

If you need to add a new detector for an obscure case, OS, or cannot wait for a pull request to get merged you can add 
more detectors when instantiating the `Detector` class:

```php
use Phlux\Component\OperatingSystem\Detector;

$detector = new Detector([
    \MyNamespace\OperatingSystem\ObscureOS::class,
    // You can add detectors as you want if they all implements Phlux\Component\OperatingSystem\System\SystemInterface
]);

```

Implement `SystemInterface` if the OS is not a derivated distribution...

```php
use Phlux\Component\OperatingSystem\System\SystemInterface;
 
class ObscureOS implements SystemInterface
{
    public function isRunningOS(): bool
    {
        // Detection logic
    }
}
```

...or just extend another OS

```php
use Phlux\Component\OperatingSystem\System\Linux;

class ObscureOS extends Linux
{
    public function isRunningOS(): bool
    {
        // Your detection logic
    }
}
```
