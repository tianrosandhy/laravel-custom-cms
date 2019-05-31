<?php
namespace Module\Base;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Validator;
use Illuminate\Foundation\AliasLoader;

class BaseServiceProvider extends ServiceProvider
{
	protected $namespace = 'Module\Base\Http\Controllers';

	public function boot(){
		//load migrations table
		$this->loadMigrationsFrom(realpath(__DIR__."/Migrations"));
	}


	public function register(){
		$this->mapping($this->app->router);
		$this->loadViewsFrom(realpath(__DIR__."/Views"), 'base');
		$this->loadModules();
	}

	protected function loadModules(){
	    $listModule = config('modules.load');
	    if($listModule){
		    foreach($listModule as $mod){
			    $this->app->register($mod);
		    }
	    }
	}


	protected function mapping(Router $router){
		$router->group([
			'namespace' => $this->namespace, 
			'middleware' => [
				'web'
			]
		], function($router){
			require realpath(__DIR__."/Routes/install.php");
		});

	}


}