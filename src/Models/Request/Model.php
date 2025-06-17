<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Request;

use JsonSerializable;

abstract readonly class Model implements JsonSerializable
{
    /**
     * @return array<string|int>|null
     */
    abstract public function getQuery(): ?array;
}
