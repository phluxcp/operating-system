<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\Filesystem;

interface FilesystemInterface
{
    public function exists(string $path): bool;
    public function read(string $path): string;
}