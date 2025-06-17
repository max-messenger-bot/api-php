<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Response\Subscriptions;

use DateTime;
use MaxMessenger\Api\Models\Enums\UpdateType;
use MaxMessenger\Api\Models\Response\Model;

/**
 * Объект Update представляет различные типы событий, произошедших в чате. Смотрите его наследников.
 *
 * @api
 */
abstract class Update extends Model
{
    /**
     * Время, когда произошло событие.
     */
    public function getTime(): DateTime
    {
        return $this->createDateTimeFromTimestamp($this->getTimestamp());
    }

    /**
     * Unix-время, когда произошло событие.
     */
    public function getTimestamp(): int
    {
        /** @var int */
        return $this->raw['timestamp'];
    }

    /**
     * Тип события.
     */
    abstract public function getUpdateType(): UpdateType;
}
