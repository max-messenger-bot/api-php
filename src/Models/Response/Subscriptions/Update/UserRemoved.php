<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Response\Subscriptions\Update;

use MaxMessenger\Api\Models\Enums\UpdateType;
use MaxMessenger\Api\Models\Response\Shared\User;
use MaxMessenger\Api\Models\Response\Subscriptions\Update;

/**
 * @api
 */
final class UserRemoved extends Update
{
    private ?User $user = null;

    /**
     * Администратор, который удалил пользователя из чата.
     * Может быть `null`, если пользователь покинул чат сам.
     */
    public function getAdminId(): ?int
    {
        /** @var int|null */
        return $this->raw['admin_id'] ?? null;
    }

    /**
     * ID чата, где произошло событие.
     */
    public function getChatId(): ?string
    {
        /** @var string|null */
        return $this->raw['chat_id'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getUpdateType(): UpdateType
    {
        return UpdateType::UserRemoved;
    }

    /**
     * Пользователь, удаленный из чата.
     */
    public function getUser(): User
    {
        /** @psalm-suppress MixedArgument */
        return $this->user ??= new User($this->raw['user']);
    }
}
