<?php

declare(strict_types=1);

namespace App\Services\Telegram;

use App\Factories\TelegramMessageFactory;
use App\Services\FootballData\FootballDataService;
use App\Services\Message\MessageManager;
use GuzzleHttp\Exception\GuzzleException;
use Longman\TelegramBot\Exception\TelegramException;

class TelegramService
{
    /**
     * @var FootballDataService
     */
    private $footballDataService;
    /**
     * @var TelegramSender
     */
    private $telegramSender;
    /**
     * @var TelegramMessageFactory
     */
    private $telegramMessageFactory;
    /**
     * @var MessageManager
     */
    private $messageManager;

    public function __construct(
        FootballDataService $footballDataService,
        TelegramSender $telegramSender,
        TelegramMessageFactory $telegramMessageFactory,
        MessageManager $messageManager
    ) {
        $this->telegramSender = $telegramSender;
        $this->footballDataService = $footballDataService;
        $this->telegramMessageFactory = $telegramMessageFactory;
        $this->messageManager = $messageManager;
    }

    /**
     * @param int $leagueId
     * @param string $chatId
     * @return int
     * @throws GuzzleException
     * @throws TelegramException
     */
    public function sendNewMatchesInfo(int $leagueId, string $chatId): int
    {
        $resultSends = 0;
        $fullData = $this->footballDataService->getFullDataByLeague($leagueId);
        $dataToSend = $this->messageManager->getMatchesToPublish($fullData);
        foreach ($dataToSend as $matchDataDTO) {
            $tgMessageDTO = $this->telegramMessageFactory->createTelegramMessageDTO(
                $matchDataDTO->getId(),
                $chatId,
                $this->messageManager->getFormattedMessageByMatchData($matchDataDTO)
            );
            $this->telegramSender->sendMessage($tgMessageDTO);
            $resultSends++;
        }

        return $resultSends;
    }
}
