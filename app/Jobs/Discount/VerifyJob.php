<?php

namespace App\Jobs\Discount;

use App\Enums\Discount\DiscountStatusEnum;
use App\Http\Resources\DiscountVerifyResource;
use App\Jobs\SyncJob;
use App\Repositories\Discount\IDiscountRepository;
use App\Services\Discount\Exceptions\DiscountExpiredException;
use App\Services\Discount\Exceptions\DiscountSubscriptionInvalidException;
use Carbon\Carbon;
use http\Client\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VerifyJob extends SyncJob
{
    private IDiscountRepository $discountRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $subscription, private $code)
    {
        $this->discountRepository = app()->make(IDiscountRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $discount = $this->discountRepository->findOneBy(['code' => $this->code]);

        if (!$discount) {
            throw new NotFoundHttpException();
        }

        try {
            $discountSubscription = ($discount->subscriptions)->where('id', $this->subscription)->first();

            throw_if($discountSubscription === null, new DiscountSubscriptionInvalidException());

            throw_if(
                $discount->start_at > Carbon::now() || $discount->status !== DiscountStatusEnum::Active,
                new DiscountExpiredException());

            throw_if($discount->expired_at < Carbon::now(), new DiscountExpiredException());

            if ($discount->max_use > 0) {
                throw_if($discount->max_use <= $discount->use_count, new DiscountExpiredException());
            }

            return $discount;
        } catch (Exception $exception) {
            return $this->respondError($exception->getMessage());
        }
    }
}
