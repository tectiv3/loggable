<?php
namespace tectiv3\Loggable;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot() {
        $this->publishAssets();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return [];
	}

	/**
	 * Publish the views to the application vendor/views directory
	 */
	public function registerViews() {
	}

    public function registerRoute() {
    }

    public function publishAssets() {
        $this->publishes([
            __DIR__ . '/migrations/' => base_path('database/migrations'),
        ], 'migrations');
    }

}
