<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient;

use MaxMessenger\Api\HttpClient\Contracts\HttpMethod;
use MaxMessenger\Api\HttpClient\Contracts\HttpRequestInterface;
use MaxMessenger\Api\HttpClient\Exceptions\JsonHttpClient\BodyRequiredException;

readonly class HttpRequest implements HttpRequestInterface
{
    /**
     * @param array<string|int>|null $query
     * @param string[]|null $headers
     */
    public function __construct(
        private HttpMethod $method,
        private string $url,
        private ?array $query = null,
        private string|array|null $body = null,
        private ?array $headers = null
    ) {
        ////private array $files = [],
    }

    public function getBody(): string|array
    {
        if ($this->body === null) {
            throw new BodyRequiredException($this);
        }

        return $this->body;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    public function getMethod(): HttpMethod
    {
        return $this->method;
    }

    /**
     * @inheritDoc
     */
    public function getQuery(): ?array
    {
        return $this->query;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
