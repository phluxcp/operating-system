<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\Filesystem;

use Phlux\Component\OperatingSystem\Exception\RuntimeException;

final class InMemory implements FilesystemInterface
{
    /**
     * @param array<string, string> $files
     */
    public function __construct(
        private array $files,
    ) {}

    public function exists(string $path): bool
    {
        return array_key_exists($path, $this->files);
    }

    public function read(string $path): string
    {
        if (!$this->exists($path)) {
            throw new RuntimeException("File not found: $path");
        }

        return $this->files[$path];
    }
}
