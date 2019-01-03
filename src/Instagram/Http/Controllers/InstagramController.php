<?php
namespace Module\Instagram\Http\Controllers;

use Module\Main\Http\Repository\CrudRepository;
use Module\Main\Http\Controllers\AdminBaseController;
use Module\Instagram\Http\Skeleton\InstagramSkeleton;
use Validator;
use InstagramScraper\Instagram;
use Module\Instagram\Http\Traits\Grabable;
use Module\Instagram\Http\Traits\Importable;

class InstagramController extends AdminBaseController
{
	use Grabable, Importable;

	public $hint = 'instagram';

	public function repo(){
		//mendefinisikan repo / model apa yang ingin digunakan
		//inputan berupa inisial sesuai yang didaftarkan di config('model')
		return $this->hint;
	}

	public function skeleton(){
		return new InstagramSkeleton;
	}

	public function index(){
		$datatable = $this->skeleton;
		$title = self::usedLang('index.title');
		$hint = $this->hint();

		return view('instagram::index', compact(
			'title',
			'hint',
			'datatable'
		));
	}

	public function languageData(){
		return [
			'index.title' => 'Instagram Aggregator Data',
			'create.title' => 'Add New Instagram',
			'edit.title' => 'Edit Instagram Data',

			'store.success' => 'Instagram data has been saved',
			'update.success' => 'Instagram data has been updated',
			'delete.success' => 'Instagram data has been deleted',
		];
	}

	public function image_field(){
		return ['stored_url'];
	}



	protected function errorTemplate($msg){
		return '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>';
	}

	protected function successTemplate($msg){
		return '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>';
	}

}