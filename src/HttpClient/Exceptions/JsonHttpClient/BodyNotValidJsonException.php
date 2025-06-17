<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Exceptions\JsonHttpClient;

use JsonException;
use JsonSerializable;

/**
 * @api
 */
final class BodyNotValidJsonException extends RequestException
{
    public function __construct(
        private JsonSerializable $body,
        ?JsonException $previous = null
    ) {
        parent::__construct('Not valid json.', 0, $previous);
    }

    public function getBody(): JsonSerializable
    {
        return $this->body;
    }
}
