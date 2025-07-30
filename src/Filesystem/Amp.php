<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\Filesystem;

use Amp\File;

final class Amp implements FilesystemInterface
{
    public function exists(string $path): bool
    {
        return File\exists($path);
    }

    public function read(string $path): string
    {
        return File\read($path);
    }
}