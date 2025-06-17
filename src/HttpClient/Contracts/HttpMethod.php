<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Contracts;

enum HttpMethod: string
{
    case Get = 'GET';
    case Post = 'Post';
    case Put = 'PUT';
    case Patch = 'PATCH';
    case Delete = 'DELETE';
}
