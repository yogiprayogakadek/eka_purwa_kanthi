<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->jabatan->nama_jabatan === 'Admin';
        });

        Gate::define('ketua', function ($user) {
            return $user->jabatan->nama_jabatan === 'Ketua';
        });

        Gate::define('sekretaris', function ($user) {
            return $user->jabatan->nama_jabatan === 'Sekretaris';
        });

        Gate::define('bendahara', function ($user) {
            return $user->jabatan->nama_jabatan === 'Bendahara';
        });

        Gate::define('anggota', function ($user) {
            return $user->jabatan->nama_jabatan === 'Anggota';
        });

        Gate::define('ketua_sekretaris', function ($user) {
            return $user->jabatan->nama_jabatan === 'Ketua' || $user->jabatan->nama_jabatan === 'Sekretaris';
        });

        Gate::define('ketua_bendahara', function ($user) {
            return $user->jabatan->nama_jabatan === 'Ketua' || $user->jabatan->nama_jabatan === 'Bendahara';
        });
    }
}
