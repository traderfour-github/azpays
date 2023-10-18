<?php

namespace App\Repositories\Transactions;

interface ITransactionRepository
{
    public function get(mixed $user_id, array $data);
    public function read(string $uuid, mixed $user_id);
    public function merchantTransactionsList(mixed $user_id, string $merchant_id);
}
