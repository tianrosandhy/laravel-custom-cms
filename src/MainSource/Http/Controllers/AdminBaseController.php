<?php
namespace Module\Main\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Module\Main\Http\Repository\CrudRepository;
use ImageService;
use Module\Main\Http\Traits\BasicCrud;
use Module\Main\Http\Middleware\AdminAuth;

class AdminBaseController extends Controller
{
	//basic CRUD (index, create, store, edit, show, delete) ada di trait ini semua
	use BasicCrud;

	public 
		$request,
		$model,
		$hint,
		$repo,
		$skeleton,
		$language = [],
		$multi_language = false;

	public function __construct(Request $req){
		$this->request = $req;
		$this->middleware(AdminAuth::class);

		//register repository globally
		if(method_exists($this, 'repo')){
			$this->model = $this->repo();
			$this->useRepo($this->repo());
		}

		if(method_exists($this, 'skeleton')){
			$this->skeleton = $this->skeleton();
		}

		if(method_exists($this, 'languageData')){
			$this->language = $this->languageData();
		}
	}

	public function useRepo($alias=''){
		$this->repo = new CrudRepository($this->repo());
	}

	public function languageData(){
		//grab data bahasa langsung dari config aja sekalian skrg
		return config('module-setting.'.$this->hint.'.lang_data');
	}


	public function hint($var=''){
		if(strlen($var) > 0)
			return $var;
		return $this->model;
	}


	//utk request datatable
	public function table(){
		//return output datatable json instance
		return $this->skeleton->table();
	}


	public function switch(){
		if(strlen($this->model) == 0){
			abort(404);
		}

		$table = new CrudRepository($this->model);
		$this->request->validate([
			'field' => 'required',
			'id' => 'required|numeric',
			'value' => 'required|numeric|min:0|max:1'
		]);

		$table->update($this->request->id, [
			$this->request->field => $this->request->value
		]);

		return [
			'type' => 'success',
			'message' => 'Data has been updated'
		];
	}

	public function afterValidation($mode='create'){
		//
	}

	public function afterCrud($instance){
		//
	}

	public function storeLanguage($instance=[]){
		if(empty($instance)){
			return false;
		}

		//get table name from instance
		$table = $instance->getTable();
		$id = $instance->id;
		$post = $this->request->all();

		if(isset($post['_token'])){
			unset($post['_token']);
		}

		$n = 0;
		foreach(available_lang() as $lang){
			foreach($post as $field => $item){
				if(isset($item[$lang])){
					$content = $item[$lang];
					if(strpos($field, 'seo_') === false){
						$n += self::insertLanguage($lang, $table, $field, $id, $content);
					}
				}
			}
		}

		return $n;
	}

	protected function insertLanguage($lang, $table, $field, $id, $content){
		$repo = (new CrudRepository('translator'));
		$cek = $repo->filterFirst([
			['table', '=', $table],
			['field', '=', $field],
			['lang', '=', $lang],
			['id_field', '=', $id]
		]);

		if(!empty($cek)){
			//update
			$cek->content = $content;
			$cek->save();
		}
		else{
			$repo->insert([
				'table' => $table,
				'field' => $field,
				'lang' => $lang,
				'id_field' => $id,
				'content' => $content
			]);
		}
		//buat increment aja. hehe
		return 1;
	}

	//ketika delete data, dan ingin remove language datanya juga
	public function removeLanguage($instance){
		$repo = (new CrudRepository('translator'));
		$table = $instance->getTable();
		$id = $instance->id;

		$data = $repo->filter([
			['table', '=', $table],
			['id_field', '=', $id]
		]);

		if($data->count() > 0){
			$ids = $data->pluck('id')->toArray();
			$repo->delete($ids); //remove all IDs
		}
	}

	public function removeImage($instance, $field='image'){
		if(isset($instance->{$field})){
			ImageService::removeImage($instance->{$field});
		}
	}
	

}