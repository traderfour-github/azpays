<?php

namespace App\Jobs\Payment;

use Carbon\Carbon;
use App\Jobs\SyncJob;
use App\Models\Gateway;
use App\Models\Network;
use App\Models\Payment;
use App\Enums\Payment\PaymentStatus;
use App\Events\Payment\PayEvent;
use PhpParser\ErrorHandler\Collecting;
use App\Repositories\Payments\IPaymentRepository;
use App\Jobs\Payment\Pipes\PaymentBasePipe;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class PayJob extends SyncJob
{
    private IPaymentRepository $paymentRepository;
    private string $errorMessage;

    /**
     * Create a new job instance.
     */
    public function __construct(private $token, private $data)
    {
        $this->paymentRepository = app()->make(IPaymentRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if (is_string($data = $this->pay($this->token, $this->data)))
            throw new InvalidParameterException();

        event(new PayEvent($data));

        return $data;
    }

    protected function pay () {
        $payment = $this->paymentRepository->readPaymentByToken($this->token);
        if (! $this->startPayment($payment, $this->data))
            return $this->errorMessage;

        $payment->refresh();
        $payment->networks = $this->getAvailableNetworks($payment);

        return $payment;
    }

    protected function startPayment(Payment $payment, array $params): bool
    {
        $pipes = [
            CheckStatusPipe::class,
            CheckPasswordPipe::class,
            // todo: other metas
        ];
        $basePipe = pipeline()
            ->send(new PaymentBasePipe($payment, $payment->metas, $params))
            ->through($pipes)
            ->then(function (PaymentBasePipe $basePipe) {
                if (! $basePipe->errorMessages) {
                    $basePipe->payment->update([
                        Payment::STATUS => PaymentStatus::STARTED,
                        Payment::STARTED_AT => Carbon::now(),
                    ]);
                }

                return $basePipe;
            });
        if ($basePipe->errorMessages) {
            $this->errorMessage = $basePipe->errorMessages[0];
            return false;
        }

        return true;
    }

    protected function getAvailableNetworks(Payment $payment): Collecting
    {
         /** @var Collection $gateways */
        $gateways = $payment->payee->gateways;
        $networks = (new  NetworkRepository)->getNetworksByGatewaysIds($gateways->pluck(Gateway::ID)->toArray());

        $pipes = [
            CheckCountriesPipe::class,
            // todo: more checks
        ];

        $basePipe = pipeline()
            ->send(new PaymentBasePipe($payment, networks: $networks))
            ->through($pipes)
            ->then(function (PaymentBasePipe $basePipe) use ($gateways) {
                $basePipe->networks->each(function (Network $network) use ($gateways) {
                    $network->gateway = $gateways->firstWhere(Gateway::ID, $network->{Network::GATEWAY_ID});
                });

                return $basePipe;
            });

        return $basePipe->networks;
    }
}
