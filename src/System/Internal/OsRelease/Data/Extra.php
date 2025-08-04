<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System\Internal\OsRelease\Data;

/**
 * Non standard fields in the os-release file.
 */
final readonly class Extra
{
    public function __construct(
        /** @var array<non-empty-string, non-empty-string> */
        public array $data = [],
    ) {}
}
