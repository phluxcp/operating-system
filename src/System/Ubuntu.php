<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System;

use Phlux\Component\OperatingSystem\Filesystem\FilesystemInterface;

readonly class Ubuntu extends Debian
{
    const LSB_RELEASE_KEY_DISTRIB_RELEASE = 'DISTRIB_RELEASE';

    public function __construct(
        string $debianVersion,
        public string $ubuntuVersion,
        public string $codename,
    ) {
        parent::__construct($debianVersion);
    }

    public static function getIdentifier(): string
    {
        return 'ubuntu';
    }

    public static function buildFromEnvironment(FilesystemInterface $filesystem): self
    {
        $parentSystem = parent::buildFromEnvironment($filesystem);

        $filesystem->exists(self::ETC_DEBIAN_VERSION_PATH) ||
            throw Exception\IncompatibleOperatingSystemException::fromSystem(
                self::class,
                sprintf(
                    'Could not find "%s" file, which is required for Ubuntu systems.',
                    self::ETC_DEBIAN_VERSION_PATH,
                ),
            );

        $lsbRelease = Internal\parse_ini_string($filesystem->read('/etc/lsb-release'));

        return new self(
            debianVersion: $parentSystem->debianVersion,
            ubuntuVersion: $lsbRelease[self::LSB_RELEASE_KEY_DISTRIB_RELEASE] ??
                throw Exception\IncompatibleOperatingSystemException::fromSystem(
                    self::class,
                    sprintf(
                        'Could not find "%s" file, which is required for Ubuntu systems.',
                        self::LSB_RELEASE_KEY_DISTRIB_RELEASE,
                    ),
                ),
            codename: $lsbRelease['DISTRIB_CODENAME'] ??
                throw Exception\IncompatibleOperatingSystemException::fromSystem(
                    self::class,
                    sprintf(
                        'Could not find "DISTRIB_CODENAME" key in "%s" file, which is required for Ubuntu systems.',
                        self::OS_RELEASE_FILE,
                    ),
                ),
        );
    }

    public function toString(): string
    {
        return 'Ubuntu ' . $this->ubuntuVersion . ' (' . $this->codename . ')';
    }
}
