<?php

declare(strict_types=1);

namespace MaxMessenger\Api;

use MaxMessenger\Api\Categories\MaxBots;
use MaxMessenger\Api\Categories\MaxChats;
use MaxMessenger\Api\Categories\MaxMessages;
use MaxMessenger\Api\Categories\MaxSubscriptions;
use MaxMessenger\Api\Categories\MaxUpload;

/**
 * @api
 */
final class MaxBot
{
    use MaxBotTrait;

    public function bots(): MaxBots
    {
        return new MaxBots($this->config);
    }

    public function chats(): MaxChats
    {
        return new MaxChats($this->config);
    }

    public function messages(): MaxMessages
    {
        return new MaxMessages($this->config);
    }

    public function subscriptions(): MaxSubscriptions
    {
        return new MaxSubscriptions($this->config);
    }

    public function upload(): MaxUpload
    {
        return new MaxUpload($this->config);
    }
}
