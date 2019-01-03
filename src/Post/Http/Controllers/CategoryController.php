<?php
namespace Module\Post\Http\Controllers;

use Module\Main\Http\Repository\CrudRepository;
use Module\Main\Http\Controllers\AdminBaseController;
use Module\Post\Http\Skeleton\CategorySkeleton;
use Module\Main\Transformer\Exportable;

class CategoryController extends AdminBaseController
{
	use Exportable;

	public $hint = 'category';

	//register default repo used in this controller
	public function repo(){
		return $this->hint;
	}

	public function skeleton(){
		return new CategorySkeleton();
	}

	public function languageData(){
		return [
			'index.title' => 'Category Data',
			'create.title' => 'Add New Category',
			'edit.title' => 'Edit Category Data',

			'store.success' => 'Category data has been saved',
			'update.success' => 'Category data has been updated',
			'delete.success' => 'Category data has been deleted',
		];
	}


	public function afterCrud($instance){
		//any action after insert/update
	}
}