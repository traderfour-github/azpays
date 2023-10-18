<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\TemporaryToken;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\AbstractRepository;

class TemporaryTokenRepository extends AbstractRepository
{
    protected $model = TemporaryToken::class;

    public function findActiveToken(string $token)
    {
        return $this->getModel()->where('token', $token)
            ->where('expired_at', '>', Carbon::now())
            ->first();
    }

    public function getExpiredTokens(): Collection
    {
        return $this->getModel()
            ->where('expired_at', '<', Carbon::now())
            ->get();
    }
}
