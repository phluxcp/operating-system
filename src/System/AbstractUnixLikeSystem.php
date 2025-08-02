<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System;

use Phlux\Component\OperatingSystem\Kernel;

abstract readonly class AbstractUnixLikeSystem implements SystemInterface
{
    public const OS_RELEASE_FILE = '/etc/os-release';
}
