<?php

namespace App\Jobs\Gateway;

use App\Events\Gateway\UpdateEvent;
use App\Repositories\Gateways\IGatewayRepository;
use App\Http\Requests\Gateway\GatewayUpdateRequest;

class UpdateJob
{
    private IGatewayRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $id, private GatewayUpdateRequest $request)
    {
        $this->repository = app()->make(IGatewayRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $gateway = $this->repository->findOrFail($this->id);

        $data = $this->request->validated();

        if ($this->request->logo) {
            $data['logo'] = dispatch_sync(new UploadLogoJob($this->request->file('logo')));
        }

        if ($this->repository->update($this->id, $data)) {
            $gateway->refresh();

            event(new UpdateEvent($gateway));

            return $gateway;
        }

        return [];
    }
}
