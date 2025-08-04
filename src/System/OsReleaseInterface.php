<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System;

interface OsReleaseInterface
{
    public function getOsRelease(): Internal\OsRelease\Data;
}
