<?php namespace Nuad\Auther;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Guard;

class AutherServiceProvider extends ServiceProvider {

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
	public function boot()
	{
		$this->package('nuad/auther');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$model = $this->app['config']['auth.model'];
		$provider = new AutherUserProvider($this->app['hash'], $model);
		Auth::extend('auther', function() {
			return new Guard($provider, $this->app['session']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}