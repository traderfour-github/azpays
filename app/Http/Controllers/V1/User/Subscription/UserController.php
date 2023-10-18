<?php

namespace App\Http\Controllers\V1\User\Subscription;

use Illuminate\Http\Request;
use App\Jobs\Subscription\ShowJob;
use App\Jobs\Subscription\IndexJob;
use App\Jobs\Subscription\StoreJob;
use App\Jobs\Subscription\UpdateJob;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionResource;
use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Http\Requests\Subscription\UpdateSubscriptionRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return $this->response(SubscriptionResource::collection(dispatch_sync(new IndexJob($request->user()['id']))));
    }

    public function show(Request $request, $subscription)
    {
        return $this->response(SubscriptionResource::make(dispatch_sync(new ShowJob($request->user()['id'], $subscription))));
    }

    public function store(CreateSubscriptionRequest $request)
    {
        return $this->response(SubscriptionResource::make(dispatch_sync(new StoreJob(
            $request->user()['id'],
            $request->validated()
        ))));
    }

    public function update(UpdateSubscriptionRequest $request, $subscription)
    {
        return $this->response(SubscriptionResource::make(dispatch_sync(new UpdateJob(
            $request->user()['id'],
            $subscription,
            $request->validated()
        ))));
    }

    public function destroy(Request $request, $subscription)
    {
        return $this->response($subscription);
    }
}
