<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System;

use Phlux\Component\OperatingSystem\Filesystem\FilesystemInterface;
use Phlux\Component\OperatingSystem\Kernel;
use Phlux\Component\OperatingSystem\System\Internal\OsRelease\Exception\OsReleaseFileNotFoundException;

readonly class CentOS implements BuiltinSystemInterface, OsReleaseInterface
{
    public static function getIdentifier(): string
    {
        return 'centos';
    }

    public static function getKernel(): Kernel
    {
        return Kernel::Linux;
    }

    /**
     * @throws OsReleaseFileNotFoundException
     */
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
        return 'CentOS ' . $this->osReleaseData->version->version;
    }

    public function getOsRelease(): Internal\OsRelease\Data
    {
        return $this->osReleaseData;
    }
}
