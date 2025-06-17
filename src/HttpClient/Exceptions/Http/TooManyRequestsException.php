<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Exceptions\Http;

use MaxMessenger\Api\HttpClient\Contracts\HttpResponseInterface;

final class TooManyRequestsException extends HttpException
{
    public function __construct(HttpResponseInterface $response)
    {
        parent::__construct($response, 'Too Many Requests.');
    }
}
