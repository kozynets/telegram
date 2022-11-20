<?php

declare(strict_types=1);

namespace App\DTO;

class MatchDataDTO
{
    /**
     * @var string
     */
    private $teamHome;
    /**
     * @var string
     */
    private $teamAway;
    /**
     * @var float
     */
    private $goalsHome;
    /**
     * @var float
     */
    private $goalsAway;
    /**
     * @var float
     */
    private $xGHome;
    /**
     * @var float
     */
    private $xGAway;
    /**
     * @var string
     */
    private $status;
    /**
     * @var int
     */
    private $dateUnix;
    /**
     * @var int
     */
    private $id;

    public function __construct(
        int $id,
        string $teamHome,
        string $teamAway,
        float $goalsHome,
        float $goalsAway,
        float $xGHome,
        float $xGAway,
        string $status,
        int $dateUnix
    ) {
        $this->teamHome = $teamHome;
        $this->teamAway = $teamAway;
        $this->goalsHome = $goalsHome;
        $this->goalsAway = $goalsAway;
        $this->xGHome = $xGHome;
        $this->xGAway = $xGAway;
        $this->status = $status;
        $this->dateUnix = $dateUnix;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getDateUnix(): int
    {
        return $this->dateUnix;
    }

    /**
     * @return string
     */
    public function getTeamHome(): string
    {
        return $this->teamHome;
    }

    /**
     * @return string
     */
    public function getTeamAway(): string
    {
        return $this->teamAway;
    }

    /**
     * @return float
     */
    public function getGoalsHome(): float
    {
        return $this->goalsHome;
    }

    /**
     * @return float
     */
    public function getGoalsAway(): float
    {
        return $this->goalsAway;
    }

    /**
     * @return float
     */
    public function getXGHome(): float
    {
        return $this->xGHome;
    }

    /**
     * @return float
     */
    public function getXGAway(): float
    {
        return $this->xGAway;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
