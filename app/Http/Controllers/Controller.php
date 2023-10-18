<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Format the response data.
     *
     * @param  bool  $data    The response data.
     * @param  string  $message Message returned by request
     * @param  array  $metas   Any messages to include.
     * @param  mixed  $succeed The response succeed.
     * @return array The formatted response data.
     */
    public function response($data = [], $message = '', $metas = [], $succeed = true): array
    {
        return [
            'succeed' => $succeed,
            'message' => $message,
            'results' => $data,
            'metas' => $metas,
        ];
    }
}
