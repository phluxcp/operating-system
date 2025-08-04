<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System\Internal\OsRelease\Data;

/**
 * @see https://www.freedesktop.org/software/systemd/man/latest/os-release.html#Information%20about%20the%20version%20of%20the%20operating%20system
 */
final readonly class Version
{
    const string RELEASE_TYPE_STABLE = 'stable';
    const string RELEASE_TYPE_LTS = 'lts';
    const string RELEASE_TYPE_DEVELOPMENT = 'development';
    const string RELEASE_TYPE_EXPERIMENT = 'experiment';
    const array RELEASE_TYPES = [
        self::RELEASE_TYPE_STABLE,
        self::RELEASE_TYPE_LTS,
        self::RELEASE_TYPE_DEVELOPMENT,
        self::RELEASE_TYPE_EXPERIMENT,
    ];

    public function __construct(
        /** @var non-empty-string|null */
        public null|string $version = null,
        /** @var non-empty-string|null */
        public null|string $versionId = null,
        /** @var non-empty-string|null */
        public null|string $versionCodename = null,
        /** @var non-empty-string|null */
        public null|string $buildId = null,
        /** @var non-empty-string|null */
        public null|string $imageId = null,
        /** @var non-empty-string|null */
        public null|string $imageVersion = null,
        /** @var self::RELEASE_TYPE_* */
        public null|string $releaseType = 'stable',
    ) {}
}
