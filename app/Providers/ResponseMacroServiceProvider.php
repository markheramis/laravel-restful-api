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
        Response::macro('success', function ($data, array $notification = [], $status = 200) {
            $data = [
                'error' => false,
                'data' => $data,
            ];
            if ($notification)
                $data['notification'] = $notification;
            $data['notification'] = (count($notification)) ?? $notification;
            return Response::json($data, $status);
        });

        Response::macro('error', function ($message, $status = 400) {
            return Response::json([
                'message' => $status . ' error',
                'errors' => [
                    'message' => [$message],
                ],
                'status_code' => $status,
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
