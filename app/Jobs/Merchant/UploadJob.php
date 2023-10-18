<?php

namespace App\Jobs\Merchant;

use App\Jobs\SyncJob;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Merchants\IMerchantRepository;

class UploadJob extends SyncJob
{
    private IMerchantRepository $merchantRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $image)
    {
        $this->merchantRepository = app()->make(IMerchantRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $extension = $this->image->extension();
        $filename = Str::uuid() . "." . $extension;
        $path = config('azpays.merchant.logo_path') . $filename;
        Storage::cloud()->put($path, file_get_contents($this->image));

        return $path;
    }
}
