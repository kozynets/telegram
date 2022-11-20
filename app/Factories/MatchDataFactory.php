<?php

declare(strict_types=1);

namespace App\Factories;

use App\DTO\MatchDataDTO;

class MatchDataFactory
{
    public function createMatchData(
        int $id,
        string $teamHome,
        string $teamAway,
        float $goalsHome,
        float $goalsAway,
        float $xGHome,
        float $xGAway,
        string $status,
        int $dateUnix
    ): MatchDataDTO {
        return new MatchDataDTO(
            $id, $teamHome, $teamAway, $goalsHome, $goalsAway, $xGHome, $xGAway, $status, $dateUnix
        );
    }
}
