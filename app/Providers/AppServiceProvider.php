<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
    Schema::defaultStringLength(191);
    //     $this->app->bind('path.public', function() {
    //     return base_path('public_html');
    // });

    }

    public function boot()
    {

    }
}
