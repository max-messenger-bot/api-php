<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Exceptions;

use MaxMessenger\Api\HttpClient\Contracts\HttpResponseInterface;
use Throwable;

/**
 * @api
 */
abstract class HttpResponseException extends HttpClientException
{
    public function __construct(
        string $message,
        int $code,
        private readonly HttpResponseInterface $response,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getResponse(): HttpResponseInterface
    {
        return $this->response;
    }
}
