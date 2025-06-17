<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Request\Subscriptions;

use MaxMessenger\Api\Models\Enums\UpdateType;
use MaxMessenger\Api\Models\Request\Model;

final readonly class GetUpdates extends Model
{
    public function __construct(
        private ?int $limit,
        private ?int $timeout,
        private ?int $marker,
        private ?array $types
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getQuery(): array
    {
        $types = $this->types;
        if ($types !== null) {
            $types = array_map(
                static fn(UpdateType|string $value): string => is_string($value) ? $value : $value->value,
                $types
            );
            $types = implode(',', $types);
        }

        return array_filter([
            'limit' => $this->limit,
            'timeout' => $this->timeout,
            'marker' => $this->marker,
            'types' => $types,
        ], static fn(mixed $value): bool => $value !== null);
    }

    public function jsonSerialize(): null
    {
        return null;
    }
}
