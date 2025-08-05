<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System;

use Phlux\Component\OperatingSystem\Filesystem\FilesystemInterface;
use Phlux\Component\OperatingSystem\System\Internal\OsRelease\Exception\OsReleaseFileNotFoundException;

readonly class Ubuntu extends Debian
{
    public static function getIdentifier(): string
    {
        return 'ubuntu';
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

    public function toString(): string
    {
        return (
            'Ubuntu ' .
            $this->getOsRelease()->version->version .
            ' (' .
            $this->getOsRelease()->version->versionCodename .
            ')'
        );
    }
}
