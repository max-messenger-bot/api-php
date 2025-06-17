<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Exceptions\Http;

use MaxMessenger\Api\HttpClient\Contracts\HttpResponseInterface;
use MaxMessenger\Api\HttpClient\Exceptions\HttpResponseException;

abstract class HttpException extends HttpResponseException
{
    public function __construct(HttpResponseInterface $response, string $message)
    {
        parent::__construct($message, $response->getHttpCode(), $response);
    }

    final public static function throw(HttpResponseInterface $response): never
    {
        throw match ($response->getHttpCode()) {
            400 => new BadRequestException($response),
            401 => new AuthenticationErrorException($response),
            404 => new ResourceNotFoundException($response),
            405 => new MethodNotAllowedException($response),
            429 => new TooManyRequestsException($response),
            503 => new ServiceUnavailableException($response),
            default => new UnexpectedHttpCodeException($response),
        };
    }
}
