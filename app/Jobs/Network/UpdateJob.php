<?php

namespace App\Jobs\Network;

use App\Events\Network\UpdateEvent;
use App\Repositories\Networks\INetworkRepository;
use App\Http\Requests\Network\NetworkUpdateRequest;

class UpdateJob
{
    private INetworkRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $id, private NetworkUpdateRequest $request)
    {
        $this->repository = app()->make(INetworkRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $network = $this->repository->findOrFail($this->id);

        $data = $this->request->validated();

        if ($this->request->logo) {
            $data['logo'] = dispatch_sync(new UploadLogoJob($this->request->file('logo')));
        }

        if ($this->request->countries) {
            $data['countries'] = dispatch_sync(new ReformCountriesJob($this->request->countries));
        }

        if ($this->repository->update($this->id, $data)) {
            $network->refresh();

            event(new UpdateEvent($network));

            return $network;
        }

        return [];
    }
}
