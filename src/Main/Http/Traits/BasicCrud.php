<?php
namespace Module\Main\Http\Traits;

trait BasicCrud
{

	//default index page
	public function index(){
		$datatable = $this->skeleton;
		$title = self::usedLang('index.title');
		$hint = $this->hint();

		return view('main::master-table', compact(
			'title',
			'hint',
			'datatable'
		));
	}

	public function create(){
		$title = self::usedLang('create.title');
		$forms = $this->skeleton;
		$back = 'admin.'.$this->hint().'.index'; //back url
		$multi_language = isset($this->multi_language) ? $this->multi_language : false;
		return view('main::master-crud', compact(
			'title',
			'forms',
			'back',
			'multi_language'
		));
	}

	public function store(){
		$this->skeleton->formValidation($this->multi_language, 'create');

		//multiple values / relational type input is not processed here
		$inputData = self::getUsedField();
		$instance = $this->repo->insert($inputData);

		//multiple values / relational type can be freely managed here
		$this->afterCrud($instance);
		if($this->multi_language){
			$this->storeLanguage($instance);
		}

		\CMS::log($instance, 'ADMIN STORE DATA');

		return redirect()->route('admin.'. $this->hint() .'.index')->with('success', self::usedLang('store.success'));
	}

	public function edit($id){
		$title = self::usedLang('edit.title');
		$forms = $this->skeleton;
		$back = 'admin.'.$this->hint().'.index';

		$data = $this->repo->show($id);
		$multi_language = isset($this->multi_language) ? $this->multi_language : false;

		return view('main::master-crud', compact(
			'title',
			'forms',
			'back',
			'data',
			'multi_language'
		));
	}

	public function update($id=0){
		$this->skeleton->formValidation($this->multi_language, 'update', $id);
		$show = $this->repo->show($id);
		if(empty($show)){
			abort(404);
		}

		//multiple values / relational type input is not processed here
		$inputData = self::getUsedField();
		$instance = $this->repo->update($id, $inputData);
		//multiple values / relational type can be freely managed here
		$this->afterCrud($instance);

		if($this->multi_language){
			$this->storeLanguage($instance);
		}

		\CMS::log($instance, 'ADMIN UPDATE DATA');

		return redirect()->route('admin.'. $this->hint() .'.index')->with('success', self::usedLang('update.success'));
	}



	//ini method utk hard delete
	//soft delete menyusul
	public function delete($id=0){
		if($id == 0 && $this->request->list_id && is_array($this->request->list_id)){
			//batch remove checker
			$datas = [];
			foreach($this->request->list_id as $single_id){
				if($this->repo->exists($single_id)){
					$datas[] = $this->repo->show($single_id);
				}
			}

			if(empty($datas)){
				abort(404);
			}

			//delete loop process 
			foreach($datas as $row){
				foreach($this->image_field() as $fld){
					$this->removeImage($row, $fld);
				}
				\CMS::log($row, 'ADMIN DELETE DATA');
				$this->repo->delete($row->id);
				if($this->multi_language){
					$this->removeLanguage($row);
				}
			}

		}
		else{
			if(!$this->repo->exists($id)){
				abort(404);
			}

			$data = $this->repo->show($id);
			\CMS::log($data, 'ADMIN DELETE DATA');

			//remove image based on image fields 
			foreach($this->image_field() as $fld){
				$this->removeImage($data, $fld);
			}
			$this->repo->delete($id);

			if($this->multi_language){
				$this->removeLanguage($data);
			}

		}

		return [
			'type' => 'success',
			'message' => self::usedLang('delete.success')
		];

	}







	protected function image_field(){
		return ['image'];
	}

	protected function usedLang($param=''){
		if(!isset($this->language[$param])){
			return false;
		}

		$langdata = $this->language[$param];

		if(is_array($langdata)){
			if(isset($langdata[current_lang()])){
				return $langdata[current_lang()];
			}
			if(isset($langdata[def_lang()])){
				return $langdata[def_lang()];
			}

			return false;
		}
		return $langdata;
	}

	protected function getUsedField(){
		$active_fields = $this->skeleton->getActiveFormFields();
		$inputData = [];
		foreach($active_fields as $fields){
			if(isset($this->request->{$fields})){
				if($this->multi_language){
					$inputData[$fields] = get_lang($this->request->{$fields});
				}
				else{
					$inputData[$fields] = $this->request->{$fields};
				}
			}
		}

		return $inputData;
	}

}