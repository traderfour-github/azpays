<?php

namespace App\Repositories\Gateways;

interface IGatewayRepository
{
    public function gatewayList($user_id, array $data);
    public function gatewayDetail(string $uuid, $user_id);
    public function create($data);
    public function update(string $id, array $data);
    public function delete(string $id);
    public function findOrFail(string $id);
}
