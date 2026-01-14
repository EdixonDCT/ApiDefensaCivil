<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        Validator::extend('alpha_num_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\d\s]+$/u', $value);
        });
        Validator::extend('password_security', function ($attribute, $value) {
            return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/', $value);
        });

        Validator::extend('unique_document_by_type', function ($attribute, $value, $parameters) {
            $documentTypeId = request('document_type_id');

            if (!$documentTypeId) {
                return false;
            }

            return !DB::table('profiles')
                ->where('document_number', $value)
                ->where('document_type_id', $documentTypeId)
                ->exists();
        });
    }
}
