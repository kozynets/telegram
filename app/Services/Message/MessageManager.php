<?php

declare(strict_types=1);

namespace App\Services\Message;

use App\DTO\MatchDataDTO;
use App\Models\SendsLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MessageManager
{
    private const STATUS_COMPLETE = 'complete';
    /**
     * @var SendsLog
     */
    private $sendsLogModel;

    public function __construct(SendsLog $sendsLogModel)
    {
        $this->sendsLogModel = $sendsLogModel;
    }

    /**
     * @param MatchDataDTO[] $matches
     * @return MatchDataDTO[]
     */
    public function getMatchesToPublish(array $matches): array
    {
        $result = [];
        foreach ($matches as $match) {
            if (
                ($match->getStatus() == self::STATUS_COMPLETE) &&
                (($match->getXGHome() != 0) || ($match->getXGAway() != 0)) &&
                ($match->getDateUnix() >= Carbon::now()->subHours(5)->timestamp) &&
                !$this->sendsLogModel->isExistsByMatchId($match->getId())
            ) {
                $result[] = $match;
            }
        }

        return $result;
    }

    /**
     * @param MatchDataDTO $matchDataDTO
     * @return string
     */
    public function getFormattedMessageByMatchData(MatchDataDTO $matchDataDTO): string
    {
        return sprintf(
            "%s (%s) %s:%s (%s) %s",
            $matchDataDTO->getTeamHome(),
            $matchDataDTO->getXGHome(),
            $matchDataDTO->getGoalsHome(),
            $matchDataDTO->getGoalsAway(),
            $matchDataDTO->getXGAway(),
            $matchDataDTO->getTeamAway()
        );
    }
}
