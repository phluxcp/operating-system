<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\Filesystem;

use Phlux\Component\OperatingSystem\Filesystem\FilesystemInterface;
use Psr\Log\LoggerInterface;

final class Logger implements FilesystemInterface
{
    public function __construct(
        private FilesystemInterface $filesystem,
        private LoggerInterface $logger,
    ) {}

    public function exists(string $path): bool
    {
        $this->logger->info('Checking if path exists', ['path' => $path]);

        $exists = $this->filesystem->exists($path);

        if ($exists) {
            $this->logger->info('Path exists', ['path' => $path]);
        } else {
            $this->logger->info('Path does not exist', ['path' => $path]);
        }

        return $exists;
    }

    public function read(string $path): string
    {
        $this->logger->info('Reading contents from path', ['path' => $path]);

        try {
            $contents = $this->filesystem->read($path);
        } catch (\Throwable $e) {
            $this->logger->error('Failed to read contents', ['path' => $path, 'exception' => $e]);
            throw $e;
        }

        $this->logger->info('Contents read successfully', ['path' => $path, 'length' => strlen($contents)]);

        return $contents;
    }
}
