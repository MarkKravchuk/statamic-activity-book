<?php

namespace MarkKravchuk\StatamicActivityBook;

use Statamic\Providers\AddonServiceProvider;
use Statamic\Facades\Utility;
use Illuminate\Routing\Router;
use MarkKravchuk\StatamicActivityBook\Listeners\ActivityBookEventSubscriber;
use MarkKravchuk\StatamicActivityBook\ActivityBookViewController;

class ServiceProvider extends AddonServiceProvider
{
    protected $subscribe = [
        ActivityBookEventSubscriber::class,
    ];

    /**
     * Main function that runs after the Statamic and addon were installed
     * All the processes are initialized here
     *
     * @return void
     */
    public function bootAddon()
    {
        parent::boot();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'activity-book');

        $this->mergeConfigFrom(__DIR__.'/../config/activity-logger.php', 'admin-log');

        // Publishing to project's structure
        if ($this->app->runningInConsole()) {
            // Create simple configuration file in the /config folder of the project
            // And migration file for the plugin Model class (ActivityLog)
            // to configure (after) stable connection with DB allocated to the project
            $this->publishes([
                __DIR__.'/../config/' => config_path(),
                __DIR__.'/../migrations/' => database_path('/migrations')
            ], 'activity-book-config');
        }
        
        // Create UI page for addon, under Utilities tab
        Utility::extend(function () {
            Utility::register('activity-book')
                ->title(__('ActivityBook'))
                ->icon('book-pages')
                ->description(__('View all activities made to the content of the website'))
                ->routes(function (Router $router) {
                    // Only 1 page to be displayed
                    $router->get('/', [ActivityBookViewController::class, 'show'])->name('show');
                });
        });
    }
}
