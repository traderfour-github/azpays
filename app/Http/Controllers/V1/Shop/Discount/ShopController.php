<?php

namespace App\Http\Controllers\V1\Shop\Discount;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountResource;
use App\Http\Resources\DiscountVerifyResource;
use App\Jobs\Discount\DestroyJob;
use App\Jobs\Discount\IndexByShopJob;
use App\Jobs\Discount\ShowByShopJob;
use App\Jobs\Discount\StoreJob;
use App\Jobs\Discount\UpdateJob;
use App\Jobs\Discount\VerifyJob;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        return $this->response(DiscountResource::collection(
            dispatch_sync(new IndexByShopJob($request->user()->id))
        ));
    }

    public function show(Request $request, $discount)
    {
        $discount = dispatch_sync(new ShowByShopJob($request->user()->id, $discount));

        if (!$discount) {
            return $this->respondForbidden();
        }

        return $this->response(DiscountResource::make($discount));
    }

    public function store(Request $request)
    {
        return $this->response(DiscountResource::collection(dispatch_sync(new StoreJob(
            $request->user()->id,
            $request->get('code', null),
            $request->type,
            $request->value,
            $request->expired_at,
            $request->subscriptions,
            $request->description,
            $request->get('max_value', 0),
            $request->get('max_use', 0),
            $request->get('max_use_per_user', 0),
            $request->get('first_purchase', false),
            $request->get('start_at', null)
        ))));
    }

    public function destroy(Request $request, $discount)
    {
        return $this->response(dispatch_sync(new DestroyJob($request->user()->id, $discount)));
    }

    public function update(Request $request, $discount)
    {
        return $this->response(DiscountResource::make(
            dispatch_sync(new UpdateJob($request->user()->id, $discount))
        ));
    }

    public function verify(Request $request)
    {
        $this->request->validate([
            'code' => 'required|string',
            'subscription' => 'required|uuid|exists:subscriptions,id'
        ]);

        return $this->response(DiscountVerifyResource::make(dispatch_sync(new VerifyJob($request->subscription, $request->code))));
    }
}
