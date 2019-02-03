# Tianrosandhy Custom CMS

Tianrosandhy Custom CMS is Laravel admin panel content management system created for website.

### Requirement
- PHP 7.1.3
- At least 200MB disk space (better 200MB+ if you need to install node packages)

----

### Installation
##### 1. Install Laravel
Better Laravel 5.5 > 
```sh
composer create-project --prefer-dist laravel/laravel blog "5.7.*"
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
composer require tianrosandhy/cms
```


##### 3. Manage permission in some directory
By default, laravel will need proper read and write permission (owner) in directory "storage", and "bootstrap". 


##### 4. Register New Autoload PSR4 Namespace
All new self-created modules will be placed in modules directory. Register it namespace first. Make sure your autoload psr-4 config in composer.json will be like below.
```json
...
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Module\\" : "modules"
        },
    },
...

```

##### 5. Run Install Page
Go to [YOUR PROJECT URL]/install , and fill the site name and your first Admin credentials.


---
### Module Development
If you need to develop new module, you can create the scaffolding with this artisan command 
```sh
php artisan module:create
```
You need to provide the module name. Module name will be used as class instance name. Module name will be converted to CamelCase, and module hint will be converted to lowercase. 

After the module created, you can manage the module first : 
- Migration : Module/ModuleName/Migrations/....php
- Model : Module/ModuleName/Models/ModuleName.php
- Skeleton (table and form structure) : Module/ModuleName/Http/Skeleton/ModuleNameSkeleton.php
- Sidebar Menu : Module/ModuleName/Config/cms.php

There are 2 ways to register the newly created module. The first is by register the "Module\\ModuleName\\ModuleNameServiceProvider" to the config/app.php provider list. Or you can register it from config/load-module.php too if you want to manage the order of loaded module.
Now you can run artisan migrate to generate the database structure that you have made, and the module will be automatically added to CMS.

If the new module is still not shown in sidebar, maybe you need to add the priviledge first for the current user in Settings -> Priviledge menu.


### License
MIT
