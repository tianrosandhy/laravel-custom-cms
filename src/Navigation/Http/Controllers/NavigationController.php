<?php
namespace Module\Navigation\Http\Controllers;

use Module\Main\Http\Repository\CrudRepository;
use Module\Main\Http\Controllers\AdminBaseController;
use Module\Navigation\Http\Skeleton\NavigationSkeleton;

class NavigationController extends AdminBaseController
{
	
	public function repo(){
		return 'navigation';
	}

	public function skeleton(){
		return new NavigationSkeleton;
	}

	public function languageData(){
		return [
			'index.title' => 'Navigation Group Management',
			'create.title' => 'Add New Navigation Group',
			'edit.title' => 'Edit Navigation Group Data',

			'store.success' => 'Navigation Group data has been saved',
			'update.success' => 'Navigation Group data has been updated',
			'delete.success' => 'Navigation Group data has been deleted',
		];
	}

}