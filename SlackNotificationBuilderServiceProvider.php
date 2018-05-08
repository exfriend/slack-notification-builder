<?php

namespace Exfriend\SlackNotificationBuilder;

use Illuminate\Support\ServiceProvider;

class SlackNotificationBuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes( [
            __DIR__ . '/config/slack-notification-builder.php' => config_path( 'slack-notification-builder.php' ),
        ] );
        $this->mergeConfigFrom(
            __DIR__ . '/config/slack-notification-builder.php', 'slack-notification-builder'
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
