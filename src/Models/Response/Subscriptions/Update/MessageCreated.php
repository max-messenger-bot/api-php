<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Response\Subscriptions\Update;

use MaxMessenger\Api\Models\Enums\UpdateType;
use MaxMessenger\Api\Models\Response\Shared\Message;
use MaxMessenger\Api\Models\Response\Subscriptions\Update;

/**
 * @api
 */
final class MessageCreated extends Update
{
    private ?Message $message = null;

    /**
     * Новое созданное сообщение.
     */
    public function getMessage(): Message
    {
        /** @psalm-suppress MixedArgument */
        return $this->message ??= new Message($this->raw['message']);
    }

    /**
     * @inheritDoc
     */
    public function getUpdateType(): UpdateType
    {
        return UpdateType::MessageCreated;
    }

    /**
     * Текущий язык пользователя в формате IETF BCP 47. Доступно только в диалогах.
     */
    public function getUserLocale(): ?string
    {
        /** @var string|null */
        return $this->raw['user_locale'] ?? null;
    }
}
