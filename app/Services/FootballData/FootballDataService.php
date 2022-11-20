<?php

declare(strict_types=1);

namespace App\Services\FootballData;

use App\DTO\MatchDataDTO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class FootballDataService
{
    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var FootballDataFormatter
     */
    private $footballDataFormatter;

    public function __construct(Client $guzzleClient, FootballDataFormatter $footballDataFormatter)
    {
        $this->guzzleClient = $guzzleClient;
        $this->footballDataFormatter = $footballDataFormatter;
    }

    /**
     * @param int $leagueId
     * @return MatchDataDTO[]
     * @throws GuzzleException
     */
    public function getFullDataByLeague(int $leagueId): array
    {
        /** https://api.football-data-api.com/todays-matches?key=test85g57 */
        $response = $this->guzzleClient->get(
            sprintf("%s?key=%s&league_id=%d", getenv('FOOTBALL_DATA_API_HOST'), getenv('FOOTBALL_DATA_API_KEY'), $leagueId)
        );

        return $this->footballDataFormatter->getFormattedInfoByResponse($response);
    }
}
