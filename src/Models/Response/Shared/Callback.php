<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Response\Shared;

use DateTime;
use MaxMessenger\Api\Models\Response\Model;

/**
 * @api
 */
final class Callback extends Model
{
    private ?User $user = null;

    /**
     * Текущий ID клавиатуры.
     */
    public function getCallbackId(): string
    {
        /** @var string */
        return $this->raw['callback_id'];
    }

    /**
     * Токен кнопки.
     */
    public function getPayload(): ?string
    {
        /** @var string|null */
        return $this->raw['payload'] ?? null;
    }

    /**
     * Время, когда пользователь нажал кнопку.
     */
    public function getTime(): DateTime
    {
        return $this->createDateTimeFromTimestamp($this->getTimestamp());
    }

    /**
     * Unix-время, когда пользователь нажал кнопку.
     */
    public function getTimestamp(): int
    {
        /** @var int */
        return $this->raw['timestamp'];
    }

    /**
     * Пользователь, нажавший на кнопку.
     */
    public function getUser(): User
    {
        /** @psalm-suppress MixedArgument */
        return $this->user ??= new User($this->raw['user']);
    }
}
