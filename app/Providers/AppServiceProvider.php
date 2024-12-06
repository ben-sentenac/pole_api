<?php

namespace App\Providers;

use App\Models\Attendee;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Gate::define("update-event", function (User $user, Event $event): bool {
            return $user->id === $event->user_id;
        });

        Gate::define("delete-attendees", function (User $user, Event $event,Attendee $attendee): bool {
            return $user->id === $event->id || $user->id === $attendee->user_id;
        });
    }
}
