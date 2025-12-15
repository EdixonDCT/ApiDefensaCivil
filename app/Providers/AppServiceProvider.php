<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }
    public function boot(): void
    {
        Validator::extend('alpha_spaces', function ($attribute, $value) 
        { 
            return preg_match('/^[\pL\s]+$/u', $value); 
        });
        Validator::extend('password_security', function ($attribute, $value) 
        { 
            return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/', $value);
        });
    }
}
