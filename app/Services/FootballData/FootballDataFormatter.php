<?php

declare(strict_types=1);

namespace App\Services\FootballData;

use App\DTO\MatchDataDTO;
use App\Factories\MatchDataFactory;
use Psr\Http\Message\ResponseInterface;

class FootballDataFormatter
{
    private $matchDataFactory;

    public function __construct(MatchDataFactory $matchDataFactory)
    {
        $this->matchDataFactory = $matchDataFactory;
    }

    /**
     * @param ResponseInterface $response
     * @return MatchDataDTO[]
     */
    public function getFormattedInfoByResponse(ResponseInterface $response): array
    {
        $result = \json_decode($response->getBody()->getContents(), true);

        return $this->formatMatchInfo($result['data']);
    }

    /**
     * @param array $matches
     * @return MatchDataDTO[]
     */
    private function formatMatchInfo(array $matches): array
    {
        $result = [];
        foreach ($matches as $match) {
            $result[] = $this->matchDataFactory->createMatchData(
                $match['id'],
                $match['home_name'],
                $match['away_name'],
                $match['homeGoalCount'],
                $match['awayGoalCount'],
                $match['team_a_xg'],
                $match['team_b_xg'],
                $match['status'],
                $match['date_unix']
            );
        }

        return $result;
    }
}
