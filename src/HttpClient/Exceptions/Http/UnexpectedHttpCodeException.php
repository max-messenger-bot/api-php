<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Exceptions\Http;

use MaxMessenger\Api\HttpClient\Contracts\HttpResponseInterface;

final class UnexpectedHttpCodeException extends HttpException
{
    public function __construct(HttpResponseInterface $response)
    {
        parent::__construct(
            $response,
            sprintf('Expected http code 200, but received http code %d.', $response->getHttpCode())
        );
    }
}
