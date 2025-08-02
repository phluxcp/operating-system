<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System\Exception;

use Phlux\Component\OperatingSystem\Exception\RuntimeException;
use Phlux\Component\OperatingSystem\System\SystemInterface;

final class IncompatibleOperatingSystemException extends RuntimeException
{
    private function __construct(string $message, null|\Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }

    /**
     * @param class-string<SystemInterface> $systemClass
     * @param non-empty-string|null $details
     */
    public static function fromSystem(
        string $systemClass,
        null|string $details = null,
        null|\Throwable $previous = null,
    ): self {
        if ($details !== null) {
            $details = ' ' . $details;
        } else {
            $details = '';
        }

        return new self(
            sprintf(
                    'The system "%s" is not compatible with the current operating system.',
                    $systemClass::getIdentifier(),
                ) . $details,
            $previous,
        );
    }
}
