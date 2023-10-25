<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
            //
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
        Gate::define('adminOnly', function ($user) {
            return $user->user_type === 'admin' && $user->email_verified_at !== null;
        });
        
        Gate::define('visitAdminPages', function ($user) {
            // Allow access if the user is an admin or content creator, and their email is verified and additional info is completed.
            return in_array($user->user_type, ['admin', 'content creator']) && $user->email_verified_at !== null;
        });
        
        

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage())
                ->subject('Verify Email Address')
                ->from('admin@bpc.edu.ph', 'BPC Alumni Portal')
                ->action('Verify Email Address', $url)
                ->view('emails.verify-email', compact('url'));
        });
    }
}