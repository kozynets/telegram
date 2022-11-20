<?php

declare(strict_types=1);

namespace App\Factories;

use App\Models\SendsLog;

class SendsLogFactory
{
    public function createSendsLog(int $matchId)
    {
        $sendsLog = new SendsLog();
        $sendsLog->match_id = $matchId;

        return $sendsLog;
    }
}
