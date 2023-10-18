<?php

namespace App\Repositories\Rates;

interface IRateRepository
{
    public function rateList($user_id, array $data);
    public function rateDetail(string $uuid, $user_id);
    public function create($data);
    public function update(string $id, array $data);
    public function delete(string $id);
    public function findOrFail(string $id);
}
