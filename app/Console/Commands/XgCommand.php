<?php

namespace App\Console\Commands;

use App\Services\Telegram\TelegramService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Longman\TelegramBot\Exception\TelegramException;

class XgCommand extends Command
{
    protected $signature = 'xg:parse_results';
    protected $description = 'Parse xG of matches and publish it to telegram';

    /**
     * @var TelegramService
     */
    private $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws GuzzleException
     * @throws TelegramException
     */
    public function handle()
    {
        try {
            $this->telegramService->sendNewMatchesInfo(7432, getenv('TELEGRAM_CHAT_ID'));
//            $this->telegramService->sendNewMatchesInfo(7704, '-1001859387810');
        } catch (\Throwable $e) {
            var_dump($e->getMessage());
            die();
        }

        return Command::SUCCESS;
    }
}
