<?php

namespace App\Jobs\Discount;

use App\Http\Requests\UpdateDiscountRequest;
use App\Jobs\SyncJob;
use App\Repositories\Discount\IDiscountRepository;
use function App\Jobs\Transaction\app;

class UpdateJob extends SyncJob
{
    private IDiscountRepository $discountRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private UpdateDiscountRequest $request, private $discount)
    {
        $this->discountRepository = app()->make(IDiscountRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $discountItem = $this->discountRepository->findOneByUser($this->request->user()->id, $this->discount);

        if (!$discountItem) {
            return $this->respondForbidden();
        }

        //TODO: fire event

        return $this->updateDiscountService->perform($discountItem, $this->request->validated());
    }
}
