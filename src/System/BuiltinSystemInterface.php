<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System;

use Phlux\Component\OperatingSystem\System\SystemInterface;

/**
 * @phpstan-sealed Debian|Ubuntu|MacOS|Windows
 */
interface BuiltinSystemInterface extends SystemInterface
{
}
