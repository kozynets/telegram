<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class SendsLog extends Model
{
    protected $table = 'sends_log';

    protected $fillable = ['match_id', 'created_at'];

    public function isExistsByMatchId(int $matchId): bool
    {
        return $this->where('match_id', '=', $matchId)->exists();
    }

    public function insert(int $matchId): bool
    {
        return $this->save(['match_id' => $matchId, 'created_at' => date('Y-m-d H:i:s')]);
    }
}
