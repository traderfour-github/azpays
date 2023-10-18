<?php

namespace App\Jobs\Payment;

use App\Events\Payment\TransferInfoEvent;
use App\Jobs\SyncJob;
use App\Models\Gateway;
use App\Models\Network;
use App\Models\Payment;
use Illuminate\Support\Collection;
use PhpParser\ErrorHandler\Collecting;
use App\Jobs\Payment\Pipes\PaymentBasePipe;
use App\Repositories\Payments\IPaymentRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TransferInfoJob extends SyncJob
{
    private IPaymentRepository $paymentRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $token, private $gateway_id)
    {
        $this->paymentRepository = app()->make(IPaymentRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if (is_string($data = $this->getTransferInfo($this->token, $this->gateway_id)))
            throw new NotFoundHttpException();

        event(new TransferInfoEvent($data));

        return $data;
    }

    protected function getTransferInfo(string $token, string $gatewayUuid): Payment|string
    {
        $payment = $this->paymentRepository->readPaymentByToken($token);
        $networks = $this->getAvailableNetworks($payment);
        $gatewayIsSet = false;

        foreach ($networks as $network) {
            if ($network->{Network::GATEWAY_ID} == $gatewayUuid) {
                $network->append(['gateway' => $network->gateway]);
                $payment->transfer_wallet_address = $this->getWalletAddress($payment);
                $payment->transfer_amount = $this->getCalculatedAMount($payment);
                $payment->networks = Collection::make([$network]);
                $gatewayIsSet = true;
                break;
            }
        }

        if (! $gatewayIsSet) {
            return __('messages.payment.gateway_not_found');
        }

        return $payment;
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

    protected function getWalletAddress(Payment $payment): string
    {
        // todo: add logic to get correct wallet address for payment
        return str()->random(32);
    }

    protected function getCalculatedAMount(Payment $payment): float
    {
        // todo: add logic to calculate correct amount based on rates and network fee for payment.
        return fake()->randomFloat(8, 0, 2);
    }
}
