<?php

namespace App\Providers;

use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\UserActivity;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string|string>>
     */
    protected $listen = [
        Logout::class => [
            function ($event) {
                    UserActivity::create([
                        'user_id' => $event->user->id,
                        'activity_type' => 'Logout',
                        'page_accessed' => 'Logout',
                        'ip_address' => request()->ip(),
                        'user_agent' => request()->userAgent(),
                        'logout_at' => now()
                    ]);
                },
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}