<?php

declare(strict_types=1);

namespace MaxMessenger\Api\EventListeners\Contracts;

use MaxMessenger\Api\Events\Event;
use MaxMessenger\Api\Models\Response\Subscriptions\Update;

interface ListenerInterface
{
    public function check(Update $update): bool;

    public function handle(Event $event): void;
}
