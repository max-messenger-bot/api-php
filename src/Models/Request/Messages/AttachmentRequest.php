<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Request\Messages;

use JsonSerializable;

final readonly class AttachmentRequest implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [];
    }
}
