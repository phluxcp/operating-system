<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem;

final class Detector
{
    /**
     * @var list<class-string<System\SystemInterface>>
     */
    public const array SYSTEMS_BUILTIN = [
        System\MacOS::class,
        System\Ubuntu::class,
        System\Debian::class,
        System\Windows::class,
    ];

    /**
     * @param list<class-string<System\SystemInterface>> $systems
     */
    public function __construct(
        private Filesystem\FilesystemInterface $filesystem,
        private array $systems = self::SYSTEMS_BUILTIN,
    ) {}

    /**
     * @param class-string<System\SystemInterface> $system
     */
    public function addSystem(string $system): void
    {
        if (in_array($system, $this->systems, true)) {
            var_dump("$system is already registered.");
            return;
        }

        $this->systems[] = $system;
    }

    /**
     * @return list<class-string<System\SystemInterface>>
     */
    public function getSystems(): array
    {
        return $this->systems;
    }

    public function detect(): System\SystemInterface
    {
        foreach ($this->systems as $system) {
            try {
                return $system::buildFromEnvironment($this->filesystem);
            } catch (System\Exception\IncompatibleOperatingSystemException) {
                // Ignore and try the next system
            }
        }

        throw new Exception\NotDetectedException(
            'No compatible operating system detected. Please ensure you are running a supported system.',
        );
    }
}
