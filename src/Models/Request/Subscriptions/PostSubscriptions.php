<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Request\Subscriptions;

use MaxMessenger\Api\Models\Enums\UpdateType;
use MaxMessenger\Api\Models\Request\Model;

final readonly class PostSubscriptions extends Model
{
    /**
     * @param array<UpdateType|string>|null $updateTypes
     */
    public function __construct(
        private string $url,
        private ?array $updateTypes
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getQuery(): null
    {
        return null;
    }

    public function jsonSerialize(): array
    {
        /** @psalm-suppress RiskyTruthyFalsyComparison */
        return [
            'url' => $this->url,
            ...($this->updateTypes ? ['update_types' => $this->updateTypes] : []),
        ];
    }
}
