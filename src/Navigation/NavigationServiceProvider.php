<?php
namespace Module\Navigation;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Module\Main\BaseServiceProvider;
use Illuminate\Foundation\AliasLoader;

class NavigationServiceProvider extends BaseServiceProvider
{
	protected $namespace = 'Module\Navigation\Http\Controllers';

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
		$this->loadViewsFrom(realpath(__DIR__."/Views"), 'navigation');

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



		//auto register navigation facade
	    $this->app->bind('navigation-facade', function ($app) {
            return new Services\NavigationService($app);
        });
        AliasLoader::getInstance()->alias('Navigation', \Module\Navigation\Facades\NavigationFacade::class);

	}



}