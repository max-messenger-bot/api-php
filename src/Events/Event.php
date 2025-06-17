<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Events;

use MaxMessenger\Api\Events\Exceptions\EventExitException;
use MaxMessenger\Api\MaxBot;
use MaxMessenger\Api\Models\Response\Subscriptions\Update;

final class Event
{
    public function __construct(
        public readonly MaxBot $bot,
        public readonly Update $update
    ) {
    }

    /**
     * @throws EventExitException
     */
    public function break(): void
    {
        throw new EventExitException(false);
    }

    /**
     * @throws EventExitException
     */
    public function continue(): never
    {
        throw new EventExitException(true);
    }
}
