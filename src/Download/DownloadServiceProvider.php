<?php
namespace Module\Download;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Module\Main\BaseServiceProvider;

class DownloadServiceProvider extends BaseServiceProvider
{
	protected $namespace = 'Module\Download\Http\Controllers';

	public function boot(){
		$this->loadMigrationsFrom(realpath(__DIR__."/Migrations"));
	}

	protected function mapping(Router $router){
		$router->group(['namespace' => $this->namespace, 'middleware' => 'web'], function($router){
			$router->group(['prefix' => admin_prefix()], function(){
				require realpath(__DIR__."/Routes/api.php");
				require realpath(__DIR__."/Routes/web.php");
			});
		});
	}


	public function register(){
		$this->mapping($this->app->router);
		$this->loadViewsFrom(realpath(__DIR__."/Views"), 'download');

		//merge config
		$this->mergeConfigFrom(
	        __DIR__.'/Config/model.php', 'model'
	    );
	    $this->mergeConfigFrom(
	        __DIR__.'/Config/cms.php', 'cms'
	    );
		$this->mergeConfigFrom(
	        __DIR__.'/Config/permission.php', 'permission'
	    );
	    $this->mergeConfigFrom(
	        __DIR__.'/Config/module-setting.php', 'module-setting'
	    );
	}



}