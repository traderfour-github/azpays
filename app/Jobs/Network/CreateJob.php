<?php

namespace App\Jobs\Network;

use App\Events\Network\CreateEvent;
use App\Repositories\Networks\INetworkRepository;
use App\Http\Requests\Network\CreateNetworkRequest;

class CreateJob
{
    private INetworkRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private CreateNetworkRequest $request)
    {
        $this->repository = app()->make(INetworkRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $data = $this->request->validated();

        if ($this->request->logo) {
            $data['logo'] = dispatch_sync(new UploadLogoJob($this->request->file('logo')));
        }

        if ($this->request->countries) {
            $data['countries'] = dispatch_sync(new ReformCountriesJob($this->request->countries));
        }

        $network = $this->repository->create($data);

        if ($network) {
            event(new CreateEvent($network));

            return $network;
        }

        return [];
    }
}
