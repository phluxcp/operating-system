<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\Tests;

use Phlux\Component\OperatingSystem;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(OperatingSystem\Detector::class)]
final class DetectorTest extends Framework\TestCase
{
    public function test_get_current_systems(): void
    {
        $detector = new OperatingSystem\Detector(new OperatingSystem\Filesystem\Amp(), []);
        $this->assertSame([], $detector->getSystems());

        $systems = [
            OperatingSystem\System\Windows::class,
            OperatingSystem\System\MacOS::class,
        ];
        $detector = new OperatingSystem\Detector(new OperatingSystem\Filesystem\Amp(), $systems);
        $this->assertSame($systems, $detector->getSystems());
    }

    public function test_add_and_get_current_systems(): void
    {
        $detector = new OperatingSystem\Detector(new OperatingSystem\Filesystem\Amp(), []);

        $this->assertSame([], $detector->getSystems());

        $detector->addSystem(OperatingSystem\System\Ubuntu::class);
        $detector->addSystem(OperatingSystem\System\Windows::class);

        $this->assertSame([OperatingSystem\System\Ubuntu::class, OperatingSystem\System\Windows::class], $detector->getSystems());
    }
}