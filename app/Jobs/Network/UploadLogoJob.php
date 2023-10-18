<?php

namespace App\Jobs\Network;

use App\Jobs\SyncJob;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadLogoJob extends SyncJob
{
    /**
     * Create a new job instance.
     */
    public function __construct(private $image)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $extension = $this->image->extension();
        $filename = Str::uuid().'.'.$extension;
        $path = config('azpays.network.logo_path').$filename;
        Storage::cloud()->put($path, file_get_contents($this->image));

        return $path;
    }
}
