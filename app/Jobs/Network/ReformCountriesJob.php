<?php

namespace App\Jobs\Network;

use App\Jobs\SyncJob;

class ReformCountriesJob extends SyncJob
{
    /**
     * Create a new job instance.
     */
    public function __construct(private $countries)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $result = [];
        foreach ($this->countries as $key => $country) {
            $data = trim(strtolower($country));
            $result[] = str_replace(' ', '-', $data);
        }

        return implode(',', $result);
    }
}
