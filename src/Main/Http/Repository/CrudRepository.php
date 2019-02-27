<?php
namespace Module\Main\Http\Repository;

use Illuminate\Database\Eloquent\Model;

class CrudRepository{
	public $model;

	public function __construct($model){
		//inputan bisa berupa class model langsung, maupun initial class
		if($model instanceof Model){
			$this->model = $model;
		}
		else{
			$this->model = app(config('model.'.$model));
		}
	}

	public function with($args){
		$this->model = $this->model->with($args);
		return $this;
	}

	public function all(){
		return $this->model->get();
	}

	public function show($input, $by='id'){
		$model = $this->model;

		//get translate scope if exists
		if(method_exists($model, 'scopeGetTranslate')){
			$model = $model->with('translate');
		}

		return $model
			->where($by, $input)
			->first();
	}

	public function filter($param=[], $orderBy='id', $skip=0, $take=0, $flow='DESC'){
		$data = $this->model;
		if(count($param) > 0){
			foreach($param as $key => $prm){
				if(count($prm) == 1){
					$data = $data->where($key, $prm);
				}
				elseif(count($prm) == 2){
					$data = $data->where($prm[0], $prm[1]);
				}
				elseif(count($prm) == 3){
					$data = $data->where($prm[0], $prm[1], $prm[2]);
				}
			}
		}
		$data = $data->orderBy($orderBy, $flow);
		if($take > 0){
			$data = $data->skip($skip);
			$data = $data->take($take);
		}
		return $data->get();
	}

	public function filterPaginate($param=[], $orderBy='id', $flow='DESC', $per_page=10){
		$data = $this->model;
		if(count($param) > 0){
			foreach($param as $key => $prm){
				if(count($prm) == 1){
					$data = $data->where($key, $prm);
				}
				elseif(count($prm) == 2){
					$data = $data->where($prm[0], $prm[1]);
				}
				elseif(count($prm) == 3){
					$data = $data->where($prm[0], $prm[1], $prm[2]);
				}
			}
		}
		$data = $data->orderBy($orderBy, $flow);
		return $data->paginate($per_page);
	}

	public function filterFirst($param=[], $orderBy='id'){
		return $this->filter($param, $orderBy)->first();
	}

	public function filterDelete($param=[]){
		$data = $this->model;
		if(count($param) > 0){
			foreach($param as $key => $prm){
				if(count($prm) == 1){
					$data = $data->where($key, $prm);
				}
				elseif(count($prm) == 2){
					$data = $data->where($prm[0], $prm[1]);
				}
				elseif(count($prm) == 3){
					$data = $data->where($prm[0], $prm[1], $prm[2]);
				}
			}
		}
		return $data->delete();
	}

	public function insert($param){
		$data = $this->model;
		foreach($param as $field=>$val){
			$data->$field = $val;
		}
		$data->save();
		return $data;
	}

	public function update($id, $param){
		$instance = $this->model->find($id);
		foreach($param as $fld => $val){
			$instance->$fld = $val;
		}
		$instance->save();
		return $instance;
	}

	public function delete($id){
		if(!is_array($id)){
			$id = [$id];
		}
		return $this->model->whereIn('id', $id)->delete();
	}

	public function deleteWhere($field='id', $val=0){
		return $this->model->where($field, $val)->delete();
	}



	public function search($keyword='', $field=['title'], $isactive=false, $isactive_field='is_active'){
		$n = 0;
		$filter = $this->model;

		if($isactive){
			$filter = $filter->where($isactive_field, 1);
		}

		foreach($field as $fld){
			$pecah = explode("-", $keyword);
			foreach($pecah as $pch){
				if($n == 0){
					$filter = $filter->where($fld, 'like', '%'.$pch.'%');
				}
				else{
					$filter = $filter->orWhere($fld, 'like', '%'.$pch.'%');
				}
				$n++;
			}
		}

		return $filter->get();
	}

	public function fullSearch($keyword='', $field=['title']){
		$key = '%'.str_replace('-', '%', $keyword);
		$n=0;
		$filter = $this->model;
		foreach($field as $fld){
			if($n == 0){
				$filter = $filter->where($fld, 'like', '%'.$key.'%');
			}
			else{
				$filter = $filter->orWhere($fld, 'like', '%'.$key.'%');
			}
			$n++;
		}
		return $filter->get();
	}


	public function exists($id){
		$data = $this->show($id);
		if(!empty($data))
			return true;
		return false;
	}

}