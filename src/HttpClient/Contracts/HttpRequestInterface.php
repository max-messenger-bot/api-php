<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Contracts;

interface HttpRequestInterface
{
    public function getBody(): string|array;

    /**
     * @return string[]|null
     */
    public function getHeaders(): ?array;

    public function getMethod(): HttpMethod;

    /**
     * @return array<string|int>|null
     */
    public function getQuery(): ?array;

    public function getUrl(): string;
}
