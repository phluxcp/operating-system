<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System\Internal\OsRelease\Data;

/**
 * @see https://www.freedesktop.org/software/systemd/man/latest/os-release.html#Distribution-level%20defaults%20and%20metadata
 */
final readonly class DistributionDefaults
{
    public function __construct(
        /** @var non-empty-string|null */
        public null|string $defaultHostname = null,
        /** @var non-empty-string|null */
        public null|string $architecture = null,
        /** @var non-empty-string|null */
        public null|string $sysextLevel = null,
        /** @var non-empty-string|null */
        public null|string $confextLevel = null,
        /** @var list<non-empty-string> */
        public array $sysextScope = [],
        /** @var list<non-empty-string> */
        public array $confextScope = [],
        /** @var list<non-empty-string> */
        public array $portablePrefixes = [],
    ) {}
}
