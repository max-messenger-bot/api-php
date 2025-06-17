<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Categories;

use MaxMessenger\Api\MaxBotTrait;
use MaxMessenger\Api\Models\Response\Bots\Me;

/**
 * @api
 */
final class MaxBots
{
    use MaxBotTrait;

    public function getMeInfo(): Me
    {
        return new Me($this->get('/me'));
    }
}
