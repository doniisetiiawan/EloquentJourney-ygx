<?php

namespace App\Providers;

use App\Book;
use App\Observers\BookObserver;
use App\Observers\WelcomeUserObserver;
use App\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        User::creating(function ($user) {
            if (ends_with($user->email, '@deniedprovider.com')) {
                return false;
            }
        });

        User::created(function ($user) {
            \Mail::send('emails.welcome', ['user' => $user],
                function ($message) use ($user) {
                    $message->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Welcome to My Awesome App,' . $user->first_name . '!');
                });
        });

        Book::observe(new BookObserver());
        User::observe(new WelcomeUserObserver());
    }
}
