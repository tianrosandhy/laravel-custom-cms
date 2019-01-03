# CMS Maxsol

CMS Maxsol is Laravel admin panel content management system created for website.

### Requirement
- PHP 7.1.3
- At least 100MB disk space (better 200MB+ if you need to install node packages)

----

### Installation
##### 1. Install Laravel
Better Laravel 5.5 > 
```sh
composer create-project --prefer-dist laravel/laravel blog "5.6.*"
```
Manage the base url and mysql database connection in .env file. Base URL is required to show the assets
```sh
APP_URL={your base url}
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={your database name}
DB_USERNAME={your db connection username}
DB_PASSWORD={your db connection password}
...
```
Dont forget to create the blank database if you want to initialize from blank CMS. 


##### 2. Install CMS Maxsol
```sh
composer require maxsol/cms:dev-master
```

If you still use Laravel 5.4, you need to manually add the service provider to the "config/app.php" first. You can skip this step if you are using Laravel newer than version 5.5.
```php
	'provider' => [
		...
		...
		Intervention\Image\ImageServiceProvider::class,
		Module\Main\MainServiceProvider::class,
	],

	...
	...
	'aliases' => [
		...
		'Image' => Intervention\Image\Facades\Image::class,
	],
```


##### 3. Create the database structure
Run artisan migrate if your database is still empty to create the structure. You can skip this step if you already have the valid database file.
```sh
php artisan migrate
```

##### 4. Create new Admin
If you need to create the administrator with full access right, you can run the artisan command :
```sh
php artisan make:admin
```
You need to provide the Full Name, email, and new password. Default admin page is located in "base_url/p4n3lb04rd" by default, if you need to change this, just change in config/cms.php in admin.prefix options.


##### 5. Publish config and assets
Public assets used for styling need to be published. Run the command below to publish the config and assets
```sh
php artisan vendor:publish --tag=cms-maxsol
```

##### 5. Run Storage Symlink Command
Dont forget to create the symlink command, so all your uploaded files will be connect to the public directory
```sh
php artisan storage:link
```

##### 6. Manage permission in some directory
By default, laravel will need proper permission (owner) in directory "storage", and "bootstrap".


##### 7. Manage the middleware
You need to add middleware in web group and route middleware. Please open the app/Http/Kernel.php, and make new record like below : 

```php
protected $middlewareGroups = [
	'web' => [
		...
		...
		\Module\Main\Http\Middleware\PermissionManagement::class,
	],
];

...
...

protected $routeMiddleware = [
	...
	...
	'admin-auth' => \Module\Main\Http\Middleware\AdminAuth::class,
]
```

##### 8. Now You can test log in to the admin panel
By default, admin panel URL will be base_url/__p4n3lb04rd__. You can change it later from the config __cms.admin.prefix__.



---
### Module Development
If you need to develop new module, you can create the scaffolding with this artisan command 
```sh
php artisan module:create
```
You need to provide the module name. Module name will be used as class instance name. Module name will be converted to CamelCase, and module hint will be converted to lowercase. 

After the module created, you can manage the module first : 
- Migration : app/Modules/ModuleName/Migrations/....php
- Model : app/Modules/ModuleName/Models/ModuleName.php
- Skeleton (table and form structure) : app/Modules/ModuleName/Http/Skeleton/ModuleNameSkeleton.php
- Sidebar Menu : app/Modules/ModuleName/Config/cms.php

There are 2 ways to register the newly created module. The first is by register the "App\\Modules\\ModuleName\\ModuleNameServiceProvider" to the config/app.php provider list. Or you can register it from config/load-module.php too if you want to manage the order of loaded module.
Now you can run artisan migrate to generate the database structure that you have made, and the module will be automatically added to CMS.

If the new module is still not shown in sidebar, maybe you need to add the priviledge first for the current user in Settings -> Priviledge menu.


### License
MIT