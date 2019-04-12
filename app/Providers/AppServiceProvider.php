<?php

namespace LaravelForum\Providers;

use LaravelForum\Channel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::shreはサイト全体でグローバルに使う場合に便利、View::composerは使用するビューを指定できる
        View::share('channels', Channel::all());
    }
}
