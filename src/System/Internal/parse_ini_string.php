<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System\Internal;

/**
 * @internal
 *
 * @return array<string, string>
 */
function parse_ini_string(string $value): array
{
    $data = \parse_ini_string($value, true);

    return $data;
}
