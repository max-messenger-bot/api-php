<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Exceptions\Http;

use MaxMessenger\Api\HttpClient\Contracts\HttpResponseInterface;

final class AuthenticationErrorException extends HttpException
{
    public function __construct(HttpResponseInterface $response)
    {
        parent::__construct($response, 'Authentication Error.');
    }
}
