<?php

declare(strict_types=1);

namespace App\Factories;

use App\DTO\TelegramMessageDTO;

class TelegramMessageFactory
{
    /**
     * @param int $matchId
     * @param string $chatId
     * @param string $text
     * @return TelegramMessageDTO
     */
    public function createTelegramMessageDTO(int $matchId, string $chatId, string $text): TelegramMessageDTO
    {
        return new TelegramMessageDTO($matchId, $chatId, $text);
    }
}
