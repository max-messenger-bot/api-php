<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Request\Subscriptions;

use MaxMessenger\Api\Models\Request\Model;

final readonly class DeleteSubscriptions extends Model
{
    public function __construct(
        private string $url,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getQuery(): array
    {
        return [
            'url' => $this->url,
        ];
    }

    public function jsonSerialize(): null
    {
        return null;
    }
}
