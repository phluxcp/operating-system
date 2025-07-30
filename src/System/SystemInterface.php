<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System;

use Phlux\Component\OperatingSystem\Filesystem\FilesystemInterface;
use Phlux\Component\OperatingSystem\Kernel;

interface SystemInterface
{
    public static function getIdentifier(): string;
    public static function getKernel(): Kernel;

    public static function buildFromEnvironment(FilesystemInterface $filesystem): self;


    public function toString(): string;
}