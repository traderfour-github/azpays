<?php

namespace App\Repositories\Payments;

use App\Models\Payment;
use App\Repositories\Contracts\AbstractRepository;

class PaymentRepository extends AbstractRepository implements IPaymentRepository
{
    protected $model = Payment::class;

    public function paymentList(int $user_id)
    {
        return $this->getModel()->where('payee_id',$user_id)->get();
    }

    public function paymentDetail(string $payee_id, string $uuid)
    {
        return $this->getModel()->whereHas('payee', function ($userQuery) use ($payee_id){
            return $userQuery->where(User::ID, $payee_id);
        })->where(Payment::ID, $uuid)->firstOrFail();
    }

    public function startedPaymentList()
    {
        return $this->getModel()
            ->whereNotNull(Payment::STARTED_AT)
            ->whereNull(Payment::VERIFIED_AT)
            ->get();
    }

    public function merchantPaymentsList(string $user_id, string $merchant_id)
    {
        return $this->getModel()
            ->where('payee_id', $user_id)
            ->where('merchant_id', $merchant_id)
            ->get();
    }

    public function createPayment(array $data)
    {
        return $this->getModel()->create($data);
         // @TODO: Handle Meta Data for Metas Service
    }

    public function readPaymentByToken(string $id)
    {
        $payment = $this->getModel()->find($id);
        return $this->getModel()->where('token',$payment->token)->first();
    }

    public function update($id, $data)
    {
        return $this->getModel()->where($id)->update($data);
    }

    public function findOrFail($id)
    {
        return $this->getModel()->findOrFail($id);
    }


    public function delete($id)
    {
        return $this->getModel()->where($id)->delete();
    }
}
