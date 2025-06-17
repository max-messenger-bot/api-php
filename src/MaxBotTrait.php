<?php

declare(strict_types=1);

namespace MaxMessenger\Api;

use MaxMessenger\Api\Contracts\MaxBotConfigInterface;
use MaxMessenger\Api\Exceptions\AccessTokenNotSetException;
use MaxMessenger\Api\HttpClient\JsonHttpClient;
use MaxMessenger\Api\Models\Request\Model;

use function is_object;

trait MaxBotTrait
{
    private readonly MaxBotConfigInterface $config;

    public function __construct(string|MaxBotConfigInterface|null $accessTokenOrConfig = null)
    {
        $this->config = is_object($accessTokenOrConfig)
            ? $accessTokenOrConfig
            : new MaxBotConfig($accessTokenOrConfig);
    }

    protected function delete(string $path, ?Model $request = null): array
    {
        $baseUrl = $this->config->getBaseUrl();
        $query = $request?->getQuery() ?? [];
        $query['access_token'] = $this->getAccessToken();

        return $this->getJsonHttpClient()->delete($baseUrl . $path, $query);
    }

    protected function get(string $path, ?Model $request = null): array
    {
        $baseUrl = $this->config->getBaseUrl();
        $query = $request?->getQuery() ?? [];
        $query['access_token'] = $this->getAccessToken();

        return $this->getJsonHttpClient()->get($baseUrl . $path, $query);
    }

    protected function getJsonHttpClient(): JsonHttpClient
    {
        return new JsonHttpClient($this->config->getHttpClient());
    }

    protected function post(string $path, Model $request): array
    {
        $baseUrl = $this->config->getBaseUrl();
        $query = $request->getQuery() ?? [];
        $query['access_token'] = $this->getAccessToken();

        return $this->getJsonHttpClient()->post($baseUrl . $path, $request, $query);
    }

    private function getAccessToken(): string
    {
        $accessToken = $this->config->getAccessToken();

        /** @psalm-suppress RiskyTruthyFalsyComparison */
        return $accessToken ?: throw new AccessTokenNotSetException();
    }
}
