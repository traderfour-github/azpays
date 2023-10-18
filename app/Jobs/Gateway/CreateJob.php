<?php

namespace App\Jobs\Gateway;

use App\Events\Gateway\CreateEvent;
use App\Models\Gateway;
use App\Repositories\Gateways\IGatewayRepository;
use App\Http\Requests\Gateway\CreateGatewayRequest;

class CreateJob
{
    private IGatewayRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private CreateGatewayRequest $request)
    {
        $this->repository = app()->make(IGatewayRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $data = $this->request->validated();
        $data[Gateway::USER_ID] = $this->request->user()['id'];

        if ($this->request->logo) {
            $data['logo'] = dispatch_sync(new UploadLogoJob($this->request->file('logo')));
        }

        $gateway = $this->repository->create($data);

        if ($gateway) {
            event(new CreateEvent($gateway));

            return $gateway;
        }

        return [];
    }
}
