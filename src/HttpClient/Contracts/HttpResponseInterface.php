<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Contracts;

/**
 * @api
 */
interface HttpResponseInterface
{
    /**
     * @param list<int> $allowedCodes
     */
    public function checkHttpCode(array $allowedCodes = [200]): void;

    public function getBody(): string;

    public function getContentType(): ?string;

    /**
     * @return array<string, list<string>> $headers
     */
    public function getHeaders(): array;

    public function getHttpCode(): int;

    public function getRequest(): HttpRequestInterface;
}
