<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System\Internal\OsRelease\Data;

/**
 * @see https://www.freedesktop.org/software/systemd/man/latest/os-release.html#General%20information%20identifying%20the%20operating%20system
 */
final readonly class Identity
{
    public function __construct(
        /** @var non-empty-string */
        public string $name = 'Linux',
        /** @var non-empty-string */
        public string $id = 'linux',
        /** @var list<non-empty-string> List of identifiers that are similar to the ID. */
        public array $idLike = [],
        /** @var non-empty-string */
        public string $prettyName = 'Linux',
        /** @var non-empty-string|null */
        public null|string $cpeName = null,
        /** @var non-empty-string|null */
        public null|string $variant = null,
        /** @var non-empty-string|null */
        public null|string $variantId = null,
    ) {}
}
