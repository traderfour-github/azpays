<?php

namespace App\Jobs\Discount;

use App\Enums\Discount\DiscountStatusEnum;
use App\Events\Discount\StoreEvent;
use App\Jobs\SyncJob;
use App\Repositories\Discount\IDiscountRepository;
use Carbon\Carbon;

class StoreJob extends SyncJob
{
    private IDiscountRepository $discountRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $userId,
        private int    $type,
        private float  $value,
        private string $expiredAt,
        private array  $subscriptions,
        private ?string $code = null,
        private ?string $description = null,
        private float  $maxValue = 0,
        private int    $maxUse = 0,
        private int    $maxUsePerUser = 0,
        private bool   $firstPurchase = false,
        private ?string $startAt = null,
    )
    {
        $this->discountRepository = app()->make(IDiscountRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $discount = $this->discountRepository->create([
            'user_id'          => $this->userId,
            'code'             => $this->code ?? $this->generateUniqueCode(),
            'description'      => $this->description,
            'type'             => $this->type,
            'value'            => $this->value,
            'max_value'        => $this->maxValue,
            'max_use'          => $this->maxUse,
            'max_use_per_user' => $this->maxUsePerUser,
            'first_purchase'   => $this->firstPurchase,
            'start_at'         => $this->startAt ?? Carbon::now(),
            'expired_at'       => $this->expiredAt,
            'status'           => DiscountStatusEnum::Active,
        ]);

        $discount->subscriptions()->sync($this->subscriptions);

        if ($discount) {
            event(new StoreEvent($discount));
            return $discount;
        }

        return [];
    }

    private function generateUniqueCode(): string
    {
        $code = $this->generateCode();
        while (!($this->discountRepository->findBy(['code' => $code]))->isEmpty()) {
            $code = $this->generateUniqueCode();
        }


        return $code;
    }

    private function generateCode(): string
    {
        return $this->config->get('azpays.discount.code.prefix') . $this->str->random(
                $this->config->get('azpays.discount.code.length')
            );
    }
}
