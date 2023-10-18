<?php

namespace App\Repositories\Networks;

interface INetworkRepository
{
    public function networkList($user_id, array $data);
    public function networkDetail(string $uuid, $user_id);
    public function create($data);
    public function update(string $id, array $data);
    public function delete(string $id);
    public function findOrFail(string $id);
    public function getNetworksByGatewaysIds(array $gatewaysIds);
}
