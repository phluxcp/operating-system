<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem;

use Amp\File;

enum Kernel: string
{
    case Linux = 'linux';
    case Darwin = 'darwin';
    case Windows = 'windows';

    public static function buildFromEnvironment(): self
    {
        if (File\exists('/System/Library/CoreServices/SystemVersion.plist')) {
            return self::Darwin;
        }

        if (File\exists('/proc/version')) {
            return self::Linux;
        }

        if (File\exists('C:\\Windows\\System32\\kernel32.dll')) {
            return self::Windows;
        }

        throw new Exception\NotDetectedException('Operating system kernel not detected.');
    }
}
