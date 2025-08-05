<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\Tests;

use Phlux\Component\OperatingSystem;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(OperatingSystem\Detector::class)]
#[UsesClass(OperatingSystem\Filesystem\InMemory::class)]
final class DetectorTest extends TestCase
{
    public function test_get_current_systems(): void
    {
        $detector = new OperatingSystem\Detector(new OperatingSystem\Filesystem\InMemory([]), []);
        $this->assertSame([], $detector->getSystems());

        $systems = [
            OperatingSystem\System\Fedora::class,
            OperatingSystem\System\CentOS::class,
        ];
        $detector = new OperatingSystem\Detector(new OperatingSystem\Filesystem\InMemory([]), $systems);
        $this->assertSame($systems, $detector->getSystems());
    }

    public function test_add_and_get_current_systems(): void
    {
        $detector = new OperatingSystem\Detector(new OperatingSystem\Filesystem\InMemory([]), []);

        $this->assertSame([], $detector->getSystems());

        $detector->addSystem(OperatingSystem\System\Ubuntu::class);
        $detector->addSystem(OperatingSystem\System\Debian::class);

        $this->assertSame(
            [OperatingSystem\System\Ubuntu::class, OperatingSystem\System\Debian::class],
            $detector->getSystems(),
        );
    }
}
