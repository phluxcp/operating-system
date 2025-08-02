<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System;

use Amp\File;
use Phlux\Component\OperatingSystem\Filesystem\FilesystemInterface;
use Phlux\Component\OperatingSystem\Kernel;

readonly class Windows implements BuiltinSystemInterface
{
    public static function getIdentifier(): string
    {
        return 'windows';
    }

    public static function getKernel(): Kernel
    {
        return Kernel::Windows;
    }

    public static function buildFromEnvironment(FilesystemInterface $filesystem): self
    {
        // throw new \RuntimeException('Not implemented yet');
        $filesystem->exists($kernel32) || throw Exception\IncompatibleOperatingSystemException::fromSystem(self::class);
        return new self();
    }

    public function __construct()
    {
        // throw new \RuntimeException('Not implemented yet');
    }

    #[\Override]
    public function toString(): string
    {
        return 'Windows';
    }
}
