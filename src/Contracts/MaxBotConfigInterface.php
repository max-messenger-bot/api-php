<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Contracts;

use MaxMessenger\Api\HttpClient\Contracts\HttpClientInterface;

/**
 * @api
 */
interface MaxBotConfigInterface
{
    public function getAccessToken(): ?string;

    public function getBaseUrl(): string;

    public function getHttpClient(): HttpClientInterface;
}
