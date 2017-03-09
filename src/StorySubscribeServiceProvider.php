<?php

namespace Story\Subscribe;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class StorySubscribeServiceProvider extends ServiceProvider
{
    protected $namespace = 'Story\\Subscribe';

    public function boot()
    {
        // $this->publishes([__DIR__.'/../config/subs.php' => config_path('subs.php'),
        //     ]);
        
        $this->mergeConfigFrom(__DIR__.'/../config/subs.php', 'subscribe');
        $this->loadViewsFrom(__DIR__.'/../views/', 'subscribe');
    }

    public function register()
    {
        Route::group([
            'namespace' => '\\Story\\Subscribe\\Http',
            'middleware' => 'web'
        ], function() {
            Route::post('/subscribe', 'SubscribeController@index');
        });
    }
}