<?php namespace Nuad\Auther;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Guard;
use Illuminate\Hashing\HasherInterface;

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
		
		\Auth::extend('auther', function() {
			return $this->createAutherDriver();
		});
	}
	
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	
	public function register()
	{
		
		
	}
	
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	
	public function provides()
	{
		return array('auther');
	}
	
	public function createAutherDriver()
	{
		$provider = $this->createAutherProvider();
		return new Guard($provider, $this->app['session']);
	}
	
	public function createAutherProvider()
	{
		$model = $this->app['config']['auth.model'];
		return new AutherUserProvider($this->app['hash'], $model);
	}
}