<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient;

use Closure;
use MaxMessenger\Api\HttpClient\Contracts\HttpClientInterface;
use MaxMessenger\Api\HttpClient\Contracts\HttpRequestInterface;
use MaxMessenger\Api\HttpClient\Contracts\HttpResponseInterface;

/**
 * @api
 */
final class DebugHttpClient implements HttpClientInterface
{
    public static ?HttpRequestInterface $globalLastRequest = null;
    public static ?HttpResponseInterface $globalLastResponse = null;
    public bool $isDebug = false;
    public static bool $isGlobalDebug = true;
    public ?HttpRequestInterface $lastRequest = null;
    public ?HttpResponseInterface $lastResponse = null;
    /**
     * @var (Closure(HttpRequestInterface, HttpClientInterface): HttpResponseInterface)|null
     */
    private ?Closure $middleware = null;

    public function __construct(
        private readonly HttpClientInterface $parent
    ) {
    }

    public function request(HttpRequestInterface $request): HttpResponseInterface
    {
        $this->lastRequest = $this->isDebug ? $request : null;
        $this->lastResponse = null;

        if (self::$isGlobalDebug) {
            self::$globalLastRequest = $request;
            self::$globalLastResponse = null;
        }

        $response = $this->middleware
            ? ($this->middleware)($request, $this->parent)
            : $this->parent->request($request);


        if ($this->isDebug) {
            $this->lastResponse = $response;
        }
        if (self::$isGlobalDebug) {
            self::$globalLastResponse = $response;
        }

        return $response;
    }

    /**
     * @return $this
     */
    public function setDebug(bool $value): self
    {
        $this->isDebug = $value;

        return $this;
    }

    public static function setGlobalDebug(bool $value): void
    {
        self::$isGlobalDebug = $value;
    }

    /**
     * @param (Closure(HttpRequestInterface, HttpClientInterface): HttpResponseInterface)|null $middleware
     * @return $this
     */
    public function setMiddleware(?Closure $middleware): self
    {
        $this->middleware = $middleware;

        return $this;
    }
}
