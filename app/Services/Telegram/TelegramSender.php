<?php

declare(strict_types=1);

namespace App\Services\Telegram;

use App\DTO\TelegramMessageDTO;
use App\Factories\SendsLogFactory;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

class TelegramSender
{
    /**
     * @var SendsLogFactory
     */
    private $sendsLogFactory;

    public function __construct(SendsLogFactory $sendsLogFactory)
    {
        $this->sendsLogFactory = $sendsLogFactory;
    }

    /**
     * @param TelegramMessageDTO $telegramMessageDTO
     * @return bool
     * @throws TelegramException
     */
    public function sendMessage(TelegramMessageDTO $telegramMessageDTO): bool
    {
        new Telegram(getenv('TELEGRAM_API_TOKEN'));
        $response = Request::sendMessage(
            [
                'chat_id' => $telegramMessageDTO->getChatId(),
                'text' => $telegramMessageDTO->getText(),
            ]
        );
        $sendsLog = $this->sendsLogFactory->createSendsLog($telegramMessageDTO->getMatchId());
        $sendsLog->save();

        return $response->isOk();
    }
}
