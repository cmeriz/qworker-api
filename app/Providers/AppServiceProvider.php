<?php

namespace App\Providers;

use App\Enums\HttpStatus;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('api', function ($status, $message, $data) {

            $status = HttpStatus::getValidatedStatus($status);

            return Response::make([
                'status' => HttpStatus::getStatusLabel($status),
                'message' => $message,
                'data' => $data
            ], $status);
        });
    }
}
