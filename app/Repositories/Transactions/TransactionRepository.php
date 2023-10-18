<?php

namespace App\Repositories\Transactions;

use EloquentBuilder;
use App\Models\Transaction;
use App\Repositories\Contracts\AbstractRepository;

class TransactionRepository extends AbstractRepository implements ITransactionRepository
{
    protected $model = Transaction::class;

    public function get(mixed $user_id, array $data){
        if (empty($data)) {
            return $this->getModel()
                ->where('payee_id', $user_id)
                ->orWhere('payer_id', $user_id)
                ->get();
        } else {
            return EloquentBuilder::to($this->model, $data)
                ->where('payee_id', $user_id)
                ->orWhere('payer_id', $user_id)
                ->get();
        }
    }

    public function read(string $uuid, mixed $user_id){

        return  $this->getModel()
            ->where('id', $uuid)
            ->where('payee_id', $user_id)
            ->orWhere('payer_id', $user_id)
            ->firstOrFail();
    }

    public function merchantTransactionsList(mixed $user_id, string $merchant_id){
        return $this->getModel()
        ->where('payee_id', $user_id)
        ->whereHasMorph('transactional', [Payment::class], function ($query) use ($merchant_id) {
            $query->where('merchant_id', $merchant_id);
        })
        ->get();
    }
}
