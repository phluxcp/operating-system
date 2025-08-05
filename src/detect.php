<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * @codeCoverageIgnore
 * @throws Exception\NotDetectedException
 */
function detect(LoggerInterface $logger = new NullLogger()): System\SystemInterface
{
    $filesystem = new Filesystem\Logger(new Filesystem\Amp(), $logger);

    return new Detector($filesystem, Detector::SYSTEMS_BUILTIN)->detect();
}
