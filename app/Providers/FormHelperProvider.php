<?php

namespace App\Providers;

use Form;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
//use Illuminate\View\View;

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
        View::addExtension('html', 'php');
        Form::component('bsText', 'components.form.text', ['name', 'value', 'attributes']);
        Form::component('formButton', 'components.form.button', ['text']);
        Form::component('bsTextArea', 'components.form.textarea', ['name', 'value', 'attributes']);
        Form::component('bsEmail', 'components.form.email', ['name', 'value', 'attributes']);
    }
}
