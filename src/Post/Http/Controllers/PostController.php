<?php
namespace Module\Post\Http\Controllers;

use Module\Main\Http\Repository\CrudRepository;
use Module\Main\Http\Controllers\AdminBaseController;
use Module\Post\Http\Skeleton\PostSkeleton;
use Module\Main\Transformer\Exportable;
use DB;

class PostController extends AdminBaseController
{
	use Exportable;

	public $multi_language = true;
	public $hint = 'post';

	public function repo(){
		return $this->hint;
	}

	public function skeleton(){
		return new PostSkeleton();
	}

	public function languageData(){
		return [
			'index.title' => 'Post Management',
			'create.title' => 'Add New Post',
			'edit.title' => 'Edit Post Data',

			'store.success' => 'Post data has been saved',
			'update.success' => 'Post data has been updated',
			'delete.success' => 'Post data has been deleted',
		];
	}

	protected function image_field(){
		return ['img'];
	}

	
	//berlaku utk insert dan update, dipanggil setelah data disave/update. 
	public function afterCrud($instance){
		$ptc = new CrudRepository('post_to_category');
		$ptc->deleteWhere('post_id', $instance->id);

		if($this->request->category[def_lang()]){
			foreach($this->request->category[def_lang()] as $cat){
				$ptc->model->insert([
					'post_id' => $instance->id,
					'category_id' => $cat
				]);
			}
		}


		$pr = new CrudRepository('post_related');
		$pr->deleteWhere('post_source', $instance->id);

		if($this->request->related_to[def_lang()]){
			foreach($this->request->related_to[def_lang()] as $rel){
				$pr->model->insert([
					'post_source' => $instance->id,
					'post_related_id' => $rel
				]);
			}
		}
	}



	public function exportConfig(){
		$this->hintUsed();
		$this->exportCondition();
		$this->exportOrderBy();
		$this->setCustomField([
			'excerpt',
			'body',
			'click'
		]);
	}


}