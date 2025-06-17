<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Contracts;

interface HttpClientInterface
{
    public function request(HttpRequestInterface $request): HttpResponseInterface;
}
