<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System;

use Phlux\Component\OperatingSystem\Filesystem\FilesystemInterface;
use Phlux\Component\OperatingSystem\Kernel;

readonly class Debian extends AbstractUnixLikeSystem
{
    const string ETC_DEBIAN_VERSION_PATH = '/etc/debian_version';

    public static function getIdentifier(): string
    {
        return 'debian';
    }

    public static function getKernel(): Kernel
    {
        return Kernel::Linux;
    }

    public static function buildFromEnvironment(FilesystemInterface $filesystem): self
    {
        // TODO: no confiar en este archivo
        $filesystem->exists('' . self::ETC_DEBIAN_VERSION_PATH . '') || throw Exception\IncompatibleOperatingSystemException::fromSystem(self::class);

        $version = $filesystem->read(self::ETC_DEBIAN_VERSION_PATH);

        return new self(
            debianVersion: trim($version),
        );
    }

    public function __construct(
        public string $debianVersion,
    )
    {
    }

    public function toString(): string
    {
        return 'Debian ' . $this->debianVersion;
    }
}