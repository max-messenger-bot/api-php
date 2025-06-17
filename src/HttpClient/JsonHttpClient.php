<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient;

use JsonException;
use JsonSerializable;
use MaxMessenger\Api\HttpClient\Contracts\HttpClientInterface;
use MaxMessenger\Api\HttpClient\Contracts\HttpMethod;
use MaxMessenger\Api\HttpClient\Contracts\HttpResponseInterface;
use MaxMessenger\Api\HttpClient\Exceptions\JsonHttpClient\BodyNotValidJsonException;
use MaxMessenger\Api\HttpClient\Exceptions\JsonHttpClient\ResponseNotJsonException;
use MaxMessenger\Api\HttpClient\Exceptions\JsonHttpClient\ResponseNotValidJsonException;

use function is_array;

final readonly class JsonHttpClient
{
    public function __construct(
        private HttpClientInterface $client
    ) {
    }

    /**
     * @param array<string|int>|null $query
     */
    public function delete(string $url, ?array $query = null): array
    {
        $headers = [
            'Accept' => 'application/json',
        ];

        $request = new HttpRequest(HttpMethod::Delete, $url, $query, null, $headers);

        $response = $this->client->request($request);

        $response->checkHttpCode();

        return self::parseResponse($response);
    }

    /**
     * @param array<string|int>|null $query
     */
    public function get(string $url, ?array $query = null): array
    {
        $headers = [
            'Accept' => 'application/json',
        ];

        $request = new HttpRequest(HttpMethod::Get, $url, $query, null, $headers);

        $response = $this->client->request($request);

        $response->checkHttpCode();

        return self::parseResponse($response);
    }

    public static function parseResponse(HttpResponseInterface $response): array
    {
        if ($response->getContentType() !== 'application/json; charset=utf-8') {
            throw new ResponseNotJsonException($response);
        }

        try {
            $jsonData = json_decode($response->getBody(), true, 16, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new ResponseNotValidJsonException($response, $e);
        }

        if (!is_array($jsonData)) {
            throw new ResponseNotValidJsonException($response);
        }

        return $jsonData;
    }

    /**
     * @param array<string|int>|null $query
     */
    public function post(string $url, JsonSerializable $body, ?array $query = null): array
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type: application/json; charset=utf-8',
        ];

        try {
            $bodyString = json_encode($body, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new BodyNotValidJsonException($body, $e);
        }

        $request = new HttpRequest(HttpMethod::Post, $url, $query, $bodyString, $headers);

        $response = $this->client->request($request);

        $response->checkHttpCode();

        return self::parseResponse($response);
    }
}
