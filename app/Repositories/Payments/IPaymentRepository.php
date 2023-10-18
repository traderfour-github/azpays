<?php

namespace App\Repositories\Payments;

interface IPaymentRepository
{
    public function paymentList(int $user_id);
    public function paymentDetail(string $payee_id, string $uuid);
    public function startedPaymentList();
    public function merchantPaymentsList(string $user_id, string $merchant_id);
    public function createPayment(array $data);
    public function readPaymentByToken(string $id);
    public function update($id, array $data);
    public function findOrFail($id);
    public function delete($id);
}
