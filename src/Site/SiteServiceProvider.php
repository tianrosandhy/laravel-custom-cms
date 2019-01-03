<?php
namespace Module\Site;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class SiteServiceProvider extends ServiceProvider
{
	protected $namespace = 'Module\Site\Http\Controllers';

	public function register(){

		$this->mapping($this->app->router);
		$this->loadViewsFrom(realpath(__DIR__."/Views"), 'site');

	}

	protected function mapping(Router $router){
		$router->group(['namespace' => $this->namespace, 'middleware' => 'web'], function($router){
			require realpath(__DIR__."/Routes/public.php");
		});
	}



}