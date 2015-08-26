<?php

namespace PhpSoft\Photos\Providers;

use Illuminate\Support\ServiceProvider;
use PhpSoft\Photos\Commands\MigrationCommand;

class PhotosServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        // Set views path
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'phpsoft.photos');

        // Publish views
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/phpsoft.photos'),
        ]);

        // Publish config files
        $this->publishes([
            __DIR__ . '/../config/photos.php' => config_path('photos.php'),
        ]);

        // Register commands
        $this->commands('phpsoft.photos.command.migration');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
        $this->registerPhotoManager();
    }

    /**
     * Register the photo manager instance.
     *
     * @return void
     */
    protected function registerPhotoManager()
    {
        $this->app->singleton('phpsoft.photo', function ($app) {

            return new PhotoManager($app);
        });
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->bindShared('phpsoft.photos.command.migration', function ($app) {
            return new MigrationCommand();
        });
    }
}
