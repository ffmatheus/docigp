<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Silber\Bouncer\BouncerFacade as Bouncer;

class AppServiceProvider extends ServiceProvider
{
    /**
     *
     */
    private function configureBouncer()
    {
        Bouncer::tables([
            'permissions' => 'bouncer_permissions',
            'assigned_roles' => 'bouncer_assigned_roles',
            'roles' => 'bouncer_roles',
            'abilities' => 'bouncer_abilities',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->configureBouncer();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        info(request()->all());
    }
}
