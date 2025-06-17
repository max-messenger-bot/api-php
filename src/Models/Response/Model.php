<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Response;

use DateTime;

/**
 * @api
 */
abstract class Model
{
    final public function __construct(
        protected readonly array $raw
    ) {
    }

    /**
     * Возвращает все необработанные данные модели.
     */
    final public function getRawData(): array
    {
        return $this->raw;
    }

    protected function createDateTimeFromTimestamp(int $timestamp): DateTime
    {
        if (PHP_VERSION_ID >= 80400) {
            /**
             * @psalm-suppress UndefinedMethod
             * @var DateTime
             */
            return DateTime::createFromTimeStamp($timestamp);
        }

        return DateTime::createFromFormat('U', (string)$timestamp);
    }
}
