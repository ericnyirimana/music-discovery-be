<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Album;
use App\Models\Artist;
use App\Policies\AlbumPolicy;
use App\Policies\ArtistPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Artist::class => ArtistPolicy::class,
        Album::class => AlbumPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
