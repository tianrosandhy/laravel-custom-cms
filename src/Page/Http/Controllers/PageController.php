<?php
namespace Module\Page\Http\Controllers;

use Module\Main\Http\Repository\CrudRepository;
use Module\Main\Http\Controllers\AdminBaseController;
use Module\Page\Http\Skeleton\PageSkeleton;
use Module\Main\Transformer\Exportable;


class PageController extends AdminBaseController
{
	use Exportable;
	public $hint = 'page';

	public function repo(){
		return $this->hint;
	}

	public function skeleton(){
		return new PageSkeleton;
	}

	public function languageData(){
		return [
			'index.title' => 'Page Management',
			'create.title' => 'Add New Page',
			'edit.title' => 'Edit Page Data',

			'store.success' => 'Page data has been saved',
			'update.success' => 'Page data has been updated',
			'delete.success' => 'Page data has been deleted',
		];
	}

}