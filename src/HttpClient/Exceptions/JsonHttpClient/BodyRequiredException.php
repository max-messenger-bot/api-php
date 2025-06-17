<?php

declare(strict_types=1);

namespace MaxMessenger\Api\HttpClient\Exceptions\JsonHttpClient;

use LogicException;
use MaxMessenger\Api\HttpClient\Contracts\HttpRequestInterface;

/**
 * @api
 */
final class BodyRequiredException extends LogicException
{
    public function __construct(
        private readonly HttpRequestInterface $request
    ) {
        parent::__construct('Body required.');
    }

    public function getRequest(): HttpRequestInterface
    {
        return $this->request;
    }
}
