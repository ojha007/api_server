<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (request()->wantsJson()) {
            Broadcast::routes(["middleware" => "auth:api"]);
            Log::info("API");
        } else {
            Log::info("WEB");
            Broadcast::routes();
        }
        require base_path('routes/channels.php');
    }
}
