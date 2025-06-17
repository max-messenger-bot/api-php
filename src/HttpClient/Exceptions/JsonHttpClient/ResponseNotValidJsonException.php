<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Exceptions\JsonHttpClient;

use JsonException;
use MaxMessenger\Api\HttpClient\Contracts\HttpResponseInterface;

final class ResponseNotValidJsonException extends ResponseException
{
    public function __construct(HttpResponseInterface $response, ?JsonException $previous = null)
    {
        parent::__construct('Not valid json.', 0, $response, $previous);
    }
}
