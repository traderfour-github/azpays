<?php

namespace App\Http\Controllers\Discount;

use App\Http\Controllers\Controller;
use App\Http\Requests\Discount\CreateDiscountRequest;
use App\Http\Requests\Discount\UpdateDiscountRequest;
use App\Http\Resources\DiscountResource;
use App\Http\Resources\DiscountVerifyResource;
use App\Repositories\Discount;
use App\Services\Discount\CreateDiscountService;
use App\Services\Discount\UpdateDiscountService;
use App\Services\Discount\VerifyDiscountService;
use Exception;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function __construct(
        private CreateDiscountService $createDiscountService,
        private UpdateDiscountService $updateDiscountService,
        private DiscountRepository    $discountRepository,
        private VerifyDiscountService $verifyDiscountService
    )
    {
    }

    public function index(Request $request)
    {
        $discounts = $this->discountRepository->getByUser($request->user()->id);

        return $this->respond(DiscountResource::collection($discounts));
    }

    public function show(Request $request, $discount)
    {
        $discount = $this->discountRepository->findOneByUser($request->user()->id, $discount);

        if (!$discount) {
            return $this->respondForbidden();
        }

        return $this->respond(DiscountResource::make($discount));
    }

    public function store(CreateDiscountRequest $createDiscountRequest)
    {
        $discount = $this->createDiscountService->perform(
            $createDiscountRequest->user()->id,
            $createDiscountRequest->get('code', null),
            $createDiscountRequest->type,
            $createDiscountRequest->value,
            $createDiscountRequest->expired_at,
            $createDiscountRequest->subscriptions,
            $createDiscountRequest->description,
            $createDiscountRequest->get('max_value', 0),
            $createDiscountRequest->get('max_use', 0),
            $createDiscountRequest->get('max_use_per_user', 0),
            $createDiscountRequest->get('first_purchase', false),
            $createDiscountRequest->get('start_at', null)
        );

        return $this->respond(DiscountResource::make($discount));
    }

    public function destroy(Request $request, $discount)
    {
        $discountItem = $this->discountRepository->findOneByUser($request->user()->id, $discount);

        if (!$discountItem) {
            return $this->respondForbidden();
        }

        $discountItem->delete();

        return $this->respondEntityRemoved($discount);
    }

    public function update(UpdateDiscountRequest $request, $discount)
    {
        $discountItem = $this->discountRepository->findOneByUser($request->user()->id, $discount);

        if (!$discountItem) {
            return $this->respondForbidden();
        }

        $discount = $this->updateDiscountService->perform($discountItem, $request->validated());

        return $this->respond(DiscountResource::make($discount));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code'         => 'required|string',
            'subscription' => 'required|uuid|exists:subscriptions,id'
        ]);

        $discount = $this->discountRepository->findOneBy(['code' => $request->code]);

        if (!$discount) {
            return $this->respondEntityNotFound();
        }

        try {
            $verify = $this->verifyDiscountService->perform($discount, $request->subscription);

            return $this->respond(DiscountVerifyResource::make($verify));
        } catch (Exception $exception){

            return $this->respondError($exception->getMessage());
        }
    }
}
