<?php
namespace Module\Main\DataTable;

use Illuminate\Http\Request;
use Validator;
use Module\Main\DataTable\DataTable;
use Module\Main\Http\Repository\CrudRepository;


class Processor
{
	public $model;
	public 
		$data_table,
		$field_definition,
		$draw,
		$columns,
		$order,
		$start,
		$length,

		$query_count,
		$raw_data,
		$output;

	public function __construct(){
		$this->request = request();
	}

	public function table(){
		$this->setDataTable();
		$this->validateRequest();
		$this->process();
		$this->tableFormat();
		return $this->getResponse();
	}	

	public function tableFormat(){
		$out = [];
		foreach($this->raw_data as $row){
            $rf = $this->rowFormat($row);
            if(!empty($rf)){
                $out[] = $rf;
            }
		}

		$this->output = $out;
	}

	public function rowFormat($row, $as_excel=false){
		return []; //default use kalo pake format lama : ga mengembalikan nilai apa2
	}

	public function switcher($row, $field='is_active', $url='post/switch'){
		return view('main::inc.switchery', [
			'id' => $row->id, 
			'field' => $field,
			'url' => admin_url($url),
			'value' => $row->{$field}
		])->render();
	}

	public function checkerFormat($row, $pk='id'){
		return '<input type="checkbox" data-id="'.$row->{$pk}.'" name="multi_check['.$row->{$pk}.']" class="multichecker_datatable">';
	}

	public function validateRequest(){
		//prepare variabel disini aja sekalian
		$this->draw = $this->request->draw;
		$this->columns = $this->request->columns;
		$this->order = $this->request->order;
		$this->start = $this->request->start;
		$this->length = $this->request->length;

		return Validator::make($this->request->all(), [
			'draw' => 'required|numeric',
			'columns' => 'required|array',
			'order' => 'array',
			'start' => 'required',
			'length' => 'required',
		])->validate();
	}

	public function setModel($model){
		//inputan bisa berupa class model langsung, maupun initial class
		if($model instanceof Model){
			$this->model = $model;
		}
		else{
			$this->model = app(config('model.'.$model));
		}
	}

	public function setDataTable(){
		$i = 0;
		foreach($this->structure as $row){
			if(!$row->hide_table){
				$this->field_definition[$i] = $row->field;
				$i++;
			}
		}
	}


	public function process(){
		//prepare filter data by search query
		$filter = [];
		foreach($this->getSearchArray() as $idfield => $list){
			if(isset($this->columns[$idfield]['search']['value'])){
				$filteredString = $this->columns[$idfield]['search']['value'];
			}
			else{
				continue;
			}
			if($list['type'] == 'text'){
				//ada sedikit masalah dgn php : simbol % kalau diikutin angka, ntar jadi URL decoded string.
				//jadi kalo $filteredString ada angka didepannya, dgn terpaksa % di awalnya harus dihilangin -_-

				if(is_numeric(substr($filteredString, 0, 1))){
					$fs = $filteredString . '%';
				}
				else{
					$fs = '%' . $filteredString . '%';
				}

				$filter[] = [$list['field'], 'like', $fs];
			}
			else{
				//utk custom field type (combobox)
				$filter[] = [$list['field'], '=', $filteredString];
			}
		}

		$orderBy = 'id';
		$flow = 'DESC';
		if(isset($this->field_definition[$this->request->order[0]['column']])){
			$orderBy = $this->field_definition[$this->request->order[0]['column']];
		}
		if(isset($this->request->order[0]['dir'])){
			$flow = $this->request->order[0]['dir'];
		}

		$repo = new CrudRepository($this->model);
		$this->raw_data = $repo->filter($filter, $orderBy, $this->start, $this->length, $flow);

		$virtual_raw = $repo->filter($filter);
		$this->query_count = $virtual_raw->count();
	}



	public function getResponse(){
		return [
			'draw' => $this->request->draw,
			'data' => $this->output,
			'recordsFiltered' => $this->query_count,
			'recordsTotal' => $this->query_count
		];
	}



}