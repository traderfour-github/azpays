<?php

namespace App\Repositories\Merchants;

interface IMerchantRepository
{
    public function get(mixed $user_id, array $data);
    public function read(mixed $user_id, string $merchant_id);
    public function createMerchant(mixed $user_id, array $data);
    public function update(mixed $user_id, string $merchant_id, array $data);
    public function delete(string $merchant_id);
}
