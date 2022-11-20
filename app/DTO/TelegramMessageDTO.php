<?php

declare(strict_types=1);

namespace App\DTO;

class TelegramMessageDTO
{
    /**
     * @var string
     */
    private $chatId;
    /**
     * @var string
     */
    private $text;
    /**
     * @var int
     */
    private $matchId;

    public function __construct(int $matchId, string $chatId, string $text)
    {
        $this->chatId = $chatId;
        $this->matchId = $matchId;
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getMatchId(): int
    {
        return $this->matchId;
    }

    /**
     * @return string
     */
    public function getChatId(): string
    {
        return $this->chatId;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}
