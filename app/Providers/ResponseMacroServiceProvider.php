<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data, int $status = 200) {
            $data = [
                'error' => false,
                'data' => $data,
            ];
            return Response::json($data, $status);
        });

        Response::macro('error', function ($data, $message, int $status = 400) {
            return Response::json([
                'state' => 'error',
                'message' => $message,
                'data' => $data,
            ], $status);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
