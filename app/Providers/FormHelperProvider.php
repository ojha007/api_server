<?php

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormHelperProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.form.text', ['name', 'value', 'attributes']);
        Form::component('formButton', 'components.form.button', ['text']);
    }
}
