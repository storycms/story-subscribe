<?php

namespace Story\Subscribe;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\AliasLoader;

class StorySubscribeServiceProvider extends ServiceProvider
{
    protected $namespace = 'Story\\Subscribe';

    public function boot()
    {
        $loader = AliasLoader::getInstance();

        $this->mergeConfigFrom(__DIR__.'/../config/subscribe.php', 'subscribe');
        $this->loadViewsFrom(__DIR__.'/../views/', 'subscribe');

        $this->app->singleton('subscribe', function(){
            return new Subscribe;
        });

        $loader->alias('Subscribe', Facades\SubscribeFacade::class);
    }

    public function register()
    {
        Route::group([
            'namespace' => __NAMESPACE__.'\\Http',
            'middleware' => 'web'
        ], function() {
            Route::post(config()->get('subscribe.route_subscribe'), 'SubscribeController@index');
        });
    }
}
