<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Enums;

enum TextFormat: string
{
    case Html = 'html';
    case Markdown = 'markdown';
}
