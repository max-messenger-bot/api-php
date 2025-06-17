<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Response\Subscriptions;

use MaxMessenger\Api\Models\Response\Model;

/**
 * @api
 */
final class Subscriptions extends Model
{
    private ?array $subscriptions = null;

    /**
     * Список текущих подписок.
     *
     * @return Subscription[]
     */
    public function getSubscriptions(): array
    {
        /**
         * @var Subscription[]
         * @psalm-suppress MixedArgument
         */
        return $this->subscriptions ??= array_map(
            static fn(array $data): Subscription => new Subscription($data),
            $this->raw['subscriptions']
        );
    }
}
