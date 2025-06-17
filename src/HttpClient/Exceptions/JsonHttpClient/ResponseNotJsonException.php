<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Exceptions\JsonHttpClient;

use MaxMessenger\Api\HttpClient\Contracts\HttpResponseInterface;

final class ResponseNotJsonException extends ResponseException
{
    public function __construct(HttpResponseInterface $response)
    {
        parent::__construct('Response not json.', 0, $response);
    }
}
