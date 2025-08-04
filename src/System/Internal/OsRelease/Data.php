<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System\Internal\OsRelease;

/**
 * @see https://www.freedesktop.org/software/systemd/man/latest/os-release.html
 */
final readonly class Data
{
    public function __construct(
        public Data\Identity $identity,
        public Data\Version $version,
        public Data\Presentation $presentation,
        public Data\DistributionDefaults $distributionDefaults,
        public Data\Extra $extra,
    ) {}
}
