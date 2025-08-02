<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System;

use Phlux\Component\OperatingSystem\Filesystem\FilesystemInterface;
use Phlux\Component\OperatingSystem\Kernel;

readonly class MacOS implements SystemInterface
{
    public static function getIdentifier(): string
    {
        return 'macos';
    }

    public static function getKernel(): Kernel
    {
        return Kernel::Darwin;
    }

    public static function buildFromEnvironment(FilesystemInterface $filesystem): self
    {
        throw Exception\IncompatibleOperatingSystemException::fromSystem(self::class, 'MacOS is not supported yet');
    }

    public function __construct()
    {
        throw new \RuntimeException('Not implemented yet');
    }

    public function toString(): string
    {
        return 'MacOS';
    }
}
