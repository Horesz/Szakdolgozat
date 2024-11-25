<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * A szóló szolgáltatások regisztrálása.
     */
    public function register(): void
    {
        //
    }

    /**
     * A szóló szolgáltatások betöltése.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Definiáljuk a 'is-admin' Gate-t
        Gate::define('is_admin', function (User $user) {
            return $user->is_admin; // Győződj meg arról, hogy van egy 'is_admin' mező a felhasználó táblában
        });
    }
}
