<?php
//if there is a module you want to unregister, just hide the array values below
return [
	'load' => [
		\Module\Navigation\NavigationServiceProvider::class,
	    \Module\Post\PostServiceProvider::class,
	    \Module\Page\PageServiceProvider::class,
	    \Module\Banner\BannerServiceProvider::class,
	    \Module\Project\ProjectServiceProvider::class,
	    \Module\Instagram\InstagramServiceProvider::class,

	    //register new module service provider here 
	    //or just add to provider lists in config/app.php
	    \Module\Site\SiteServiceProvider::class,
	],
];