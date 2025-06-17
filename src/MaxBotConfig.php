<?php

declare(strict_types=1);

namespace MaxMessenger\Api;

use MaxMessenger\Api\Contracts\MaxBotConfigInterface;
use MaxMessenger\Api\HttpClient\Contracts\HttpClientInterface;
use MaxMessenger\Api\HttpClient\CurlHttpClient;
use SensitiveParameter;
use SensitiveParameterValue;

/**
 * @api
 */
final class MaxBotConfig implements MaxBotConfigInterface
{
    /**
     * @var SensitiveParameterValue<non-falsy-string>|null
     */
    private ?SensitiveParameterValue $accessToken = null;

    public function __construct(
        #[SensitiveParameter]
        ?string $accessToken = null,
        public HttpClientInterface|null $httpClient = null,
        public string $baseUrl = 'https://botapi.max.ru'
    ) {
        $this->setAccessToken($accessToken);
    }

    public function __debugInfo(): array
    {
        return [
            'httpClient' => $this->httpClient,
            'baseUrl' => $this->baseUrl,
        ];
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken?->getValue();
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getHttpClient(): HttpClientInterface
    {
        return $this->httpClient ??= new CurlHttpClient();
    }

    public function setAccessToken(?string $accessToken): self
    {
        /** @psalm-suppress RiskyTruthyFalsyComparison */
        $this->accessToken = $accessToken ? new SensitiveParameterValue($accessToken) : null;

        return $this;
    }

    public function setHttpClient(?HttpClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }
}
