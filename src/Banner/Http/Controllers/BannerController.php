<?php
namespace Module\Banner\Http\Controllers;

use Module\Main\Http\Repository\CrudRepository;
use Module\Main\Http\Controllers\AdminBaseController;
use Module\Banner\Http\Skeleton\BannerSkeleton;
use Module\Main\Transformer\Exportable;

class BannerController extends AdminBaseController
{
	use Exportable;
	public $hint = 'banner';

	public function repo(){
		return $this->hint;
	}

	public function skeleton(){
		return new BannerSkeleton;
	}

	public function languageData(){
		return [
			'index.title' => 'Banner Data',
			'create.title' => 'Add New Banner',
			'edit.title' => 'Edit Banner Data',

			'store.success' => 'Banner data has been saved',
			'update.success' => 'Banner data has been updated',
			'delete.success' => 'Banner data has been deleted',
		];
	}

	public function afterCrud($instance){
		//any action after insert/update
	}

}