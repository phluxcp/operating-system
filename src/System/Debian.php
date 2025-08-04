<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System;

use Phlux\Component\OperatingSystem\Filesystem\FilesystemInterface;
use Phlux\Component\OperatingSystem\Kernel;

readonly class Debian implements SystemInterface, OsReleaseInterface
{
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
        $parser = new Internal\OsRelease\Parser($filesystem);

        $info = $parser->parse();

        return new self($info);
    }

    public function __construct(
        private Internal\OsRelease\Data $osReleaseData,
    ) {}

    public function toString(): string
    {
        return 'Debian ' . $this->osReleaseData->version->version;
    }

    public function getOsRelease(): Internal\OsRelease\Data
    {
        return $this->osReleaseData;
    }
}
