<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System\Internal\OsRelease\Data;

/**
 * @see https://www.freedesktop.org/software/systemd/man/latest/os-release.html#Presentation%20information%20and%20links
 */
final readonly class Presentation
{
    public function __construct(
        /** @var non-empty-string|null */
        public null|string $homeUrl = null,
        /** @var non-empty-string|null */
        public null|string $documentationUrl = null,
        /** @var non-empty-string|null */
        public null|string $supportUrl = null,
        /** @var non-empty-string|null */
        public null|string $bugReportUrl = null,
        /** @var non-empty-string|null */
        public null|string $privacyPolicyUrl = null,
        /** @var non-empty-string|null */
        public null|string $supportEnd = null,
        /** @var non-empty-string|null */
        public null|string $logo = null,
        /** @var non-empty-string|null */
        public null|string $ansiColor = null,
        /** @var non-empty-string|null */
        public null|string $vendorName = null,
        /** @var non-empty-string|null */
        public null|string $vendorUrl = null,
        /** @var non-empty-string|null */
        public null|string $experiment = null,
        /** @var non-empty-string|null */
        public null|string $experimentUrl = null,
    ) {}
}
