<?php

namespace App\Providers;

use App\Services\CommandParser;
use Illuminate\Support\ServiceProvider;
use Mni\FrontYAML\Parser;

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
            $file = \File::get(storage_path('game/commands.md'));
            $parser = new Parser();
            $document = $parser->parse($file);

            return new CommandParser($document->getYAML());
        });
    }
}
