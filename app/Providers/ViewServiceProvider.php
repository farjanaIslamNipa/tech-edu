<?php

namespace App\Providers;

use App\View\Composers\CourseCategoriesComposer;
use App\View\Composers\NoticeComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['frontEnd.includes.navBar', 'frontEnd.includes.footer'], CourseCategoriesComposer::class);
        View::composer(['frontEnd.includes.navBar'], NoticeComposer::class);
    }
}
