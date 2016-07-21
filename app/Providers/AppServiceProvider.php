<?php

namespace Invoicing\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setTimerActionViewComposers();
        view()->composer('partials.topbar', 'Invoicing\ViewComposers\NavigationComposer');
        view()->composer('*', 'Invoicing\ViewComposers\UserViewComposer');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function setTimerActionViewComposers()
    {
        view()->composer('partials.topbar', 'Invoicing\ViewComposers\TimerViewComposer');
        view()->composer('workorders.show.sidebar', 'Invoicing\ViewComposers\TimerViewComposer');
    }
}
