<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient;

use MaxMessenger\Api\HttpClient\Contracts\HttpRequestInterface;
use MaxMessenger\Api\HttpClient\Exceptions\Http\HttpException;

use function in_array;

readonly class HttpResponse implements Contracts\HttpResponseInterface
{
    /**
     * @param array<string, list<string>> $headers
     */
    public function __construct(
        private HttpRequestInterface $request,
        private int $httpCode,
        private array $headers,
        private ?string $contentType,
        private string $body
    ) {
    }

    /**
     * @inheritDoc
     */
    public function checkHttpCode(array $allowedCodes = [200]): void
    {
        if (!in_array($this->getHttpCode(), $allowedCodes, true)) {
            HttpException::throw($this);
        }
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    public function getRequest(): HttpRequestInterface
    {
        return $this->request;
    }
}
