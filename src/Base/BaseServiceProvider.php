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
		$this->publishAssets();
		if ($this->app->runningInConsole()) {
	        $this->commands([
	            Console\DefaultSetting::class,
	            Console\ModuleScaffold::class,
	            Console\NewAdmin::class,
	            Console\SetRole::class,
	        ]);
	    }
	}

	protected function publishAssets(){
		//register published config
		$this->publishes([
			__DIR__.'/Config/cms.php' => config_path('cms.php'),
			__DIR__.'/Config/seo.php' => config_path('seo.php'),
			__DIR__.'/Config/permission.php' => config_path('permission.php'),
			__DIR__.'/Config/model.php' => config_path('model.php'),
			__DIR__.'/Config/image.php' => config_path('image.php'),
			__DIR__.'/Config/modules.php' => config_path('modules.php'),
			__DIR__.'/../../assets' => public_path(config('cms.admin.assets', 'admin_theme')),
		], 'tianrosandhy-cms');
	}


	public function register(){
		$this->mapping($this->app->router);
		$this->loadViewsFrom(realpath(__DIR__."/Views"), 'base');
		$this->loadModules();
		$this->mergeMainConfig();
	}

	protected function mergeMainConfig(){
		//main config files
		$this->mergeConfigFrom(
	        __DIR__.'/Config/permission.php', 'permission'
	    );
		$this->mergeConfigFrom(
	        __DIR__.'/Config/model.php', 'model'
	    );
		$this->mergeConfigFrom(
	        __DIR__.'/Config/blacklist.php', 'blacklist'
	    );
		$this->mergeConfigFrom(
	        __DIR__.'/Config/cms.php', 'cms'
	    );
	    $this->mergeConfigFrom(
	        __DIR__.'/Config/image.php', 'image'
	    );
	    $this->mergeConfigFrom(
	        __DIR__.'/Config/modules.php', 'modules'
	    );
	    $this->mergeConfigFrom(
	        __DIR__.'/Config/module-setting.php', 'module-setting'
	    );
	    $this->mergeConfigFrom(
	        __DIR__.'/Config/seo.php', 'seo'
	    );
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