<?php

namespace App\Providers;

use App\Services\CommandParser;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(CommandParser::class, function($app) {
            $file = \File::get(storage_path('game/commands.json'));
            $commands = json_decode($file,true);

            return new CommandParser($commands);
        });
    }
}
