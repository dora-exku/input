<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //扩展身份证验证规则
        Validator::extend('identitycards', function($attribute, $value, $parameters) {
            $dl = '/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[012])(0[1-9]|[12]\d|3[01])\d{3}(\d|[xX])$/';
            $xg = '/^(\s?[a-zA-Z0-9])\d{6}(\([a-zA-z0-9]\))$/';
            $tw = '/^[a-zA-Z][0-9]{9}$/';
            $am = '/^[1|5|7][0-9]{6}\([0-9Aa]\)/';
            return preg_match($dl, $value) || preg_match($xg, $value) || preg_match($tw, $value) || preg_match($am, $value);
        });
        Validator::extend('telphone', function($attribute, $value, $parameters) {
            return preg_match('/^1[34578][0-9]{9}$/', $value);
        });
    }
}
