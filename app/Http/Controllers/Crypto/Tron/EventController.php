<?php

namespace App\Http\Controllers\Crypto\Tron;

use App\Http\Controllers\Controller;
use App\Services\Crypto\Tron\EventService;

class EventController extends Controller
{

    public function __construct(
        private EventService $eventService
    ) {
    }
    public function transactions(string $transactionID)
    {
        return $this->eventService->transactions($transactionID);
    }

}
