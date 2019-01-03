<?php
namespace Module\Main\Services;

use Illuminate\Contracts\Foundation\Application;

class DataStructure
{
	public 
		$field,
		$name,
		$orderable,
		$searchable,
		$data_source,

		$hide_form,
		$hide_table,
		$form_column,
		$input_type,
		$input_attribute,
		$input_array,
		$create_validation,
		$update_validation,
		$slug_target,
		$value_source,
		$imagedir_path;

	public function __construct(Application $app){
		//manage default value
		$this->orderable = true;
		$this->searchable = true;
		$this->hide_form = false;
		$this->hide_table = false;
		$this->form_column = 12;
		$this->data_source = 'text';
		$this->input_type = 'text';
		$this->input_array = false;
		$this->slug_target = false;
		$this->value_source = false;
		$this->imagedir_path = false;
	}


	public function field($field=''){
		$this->field = $field;
		$this->inputAttribute();
		return $this;
	}

	public function checker($name='id'){
		$this->field = $name;
		$this->orderable(false);
		$this->searchable(false);
		$this->name('<input type="checkbox" name="checker_all" id="checker_all_datatable">');
		$this->hideForm();
		return $this;
	}

	public function name($name=''){
		$this->name = $name;
		return $this;
	}

	public function orderable($orderable=true){
		$this->orderable = (bool)$orderable;
		return $this;
	}

	//aliasnya orderable aja
	public function sortable($var=true){
		return $this->orderable($var);
	}

	public function searchable($searchable=true){
		$this->searchable = (bool)$searchable;
		return $this;
	}

	public function dataSource(DataSource $data){
		$this->data_source = $data->output();
		return $this;
	}


	



	//manage hide / show in table or form
	public function hideForm(){
		$this->hide_form = true;
		return $this;
	}
	
	public function hideTable(){
		$this->hide_table = true;
		return $this;
	}
	




	public function formColumn($i=12){
		$i = $i < 0 ? 1 : $i;
		$i = $i > 12 ? 12 : $i;

		$this->form_column = $i;
		return $this;
	}

	public function inputType($type='', $param=false){
		$lists = [
			'text',
			'slug',
			'number',
			'email',
			'tel',
			'password',
			'tags',
			'checkbox',
			'radio',
			'textarea',
			'richtext',
			'select',
			'select_multiple',
			'image',
			'image_multiple',
			'file',
			'file_multiple',
			'date',
			'time'
		];

		if(!in_array($type, $lists)){
			$type = 'text'; //paling default
		}
		if(in_array($type, ['select_multiple', 'image_multiple', 'file_multiple'])){
			$this->inputArray();
		}

		$this->input_type = $type;
		return $this;
	}

	public function slugTarget($target=''){
		$this->slug_target = $target.'-'.config('cms.lang.default');
		return $this;
	}

	public function inputArray($bool=true){
		$this->input_array = (bool)$bool;
		return $this;
	}

	public function inputAttribute($attr=[]){
		$fld = $this->field;
		$add = '';
		if(strpos($this->field, '[]') !== false){
			//kalo ada input field array, pindah ke paling ujung
			$fld = str_replace('[]', '', $this->field);
			$add = '[]';
		}

		$must = [
			'class' => ['form-control'],
			'name' => $fld.'['.config('cms.lang.default').']'.$add,
			'id' => 'input-'.$fld.'-'.config('cms.lang.default')
		];

		$this->input_attribute = array_merge($must, $attr);
		return $this;
	}

	public function createValidation($rule='', $same_with_update=false){
		$this->create_validation = $rule;
		if($same_with_update){
			$this->updateValidation($rule);
		}
		return $this;
	}

	public function updateValidation($rule=''){
		if(strlen($rule) == 0)
			$rule = $this->create_validation; //ambil dari create validation aja sbg nilai default
		$this->update_validation = $rule;
		return $this;
	}

	public function valueSource($table='', $filter='', $grab=''){
		$this->value_source = [$table, $filter, $grab];
		return $this;
	}

    public function setImageDirPath($path=''){
        $this->imagedir_path = $path;
        return $this;
    }












}