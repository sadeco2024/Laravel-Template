<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('sadeco', function () {
    $this->comment(
        "<options=bold>1. Crear Proyecto
            <fg=gray>composer create-project laravel/laravel sadeco"
    );
    $this->comment(
        "<options=bold>2. Instalar breeze
            <fg=gray>composer require laravel/breeze --dev
            <fg=gray>php artisan breeze:install
            <fg=gray>php artisan migrate
            <fg=gray>npm install"
            
    );
    $this->comment(
        "<options=bold>3. Instalar bootstrap
            <fg=gray>composer require twbs/bootstrap:5.3.2 
            <fg=gray>npm install"
            
    );    
    $this->comment(
        "<options=bold>3. Instalar lenguajes
            <fg=gray>composer require --dev laravel-lang/common
            <fg=gray>php artisan lang:update
        <options=bold>3.1 Configurar auto update
            <fg=gray>{
                \"scripts\": {
                    \"post-update-cmd\": [
                        \"php artisan vendor:publish --tag=laravel-assets --ansi --force\",
                        \"php artisan lang:update\"
                    ]
                }
            }"            
    );      
    $this->comment(
        "<options=bold>4. Instalar Breadcrumbs
            <fg=gray>composer require diglactic/laravel-breadcrumbs"           
    );       

    $this->comment(
        "<options=bold>5. Roles y Permisos
            <fg=gray>"           
    );       
        
    
    
})->purpose('Display an inspiring quote');

