<?php
namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Main\Http\Repository\CrudRepository;

class ProjectController extends Controller{
	public $request;

	public function __construct(Request $req){
		$this->request = $req;
	}

	public function index(){
		$lists = (new CrudRepository('project'))->filter([
			['is_active', '=', 1]
		]);

		$title = "Our Clients";
		return view('site::project-list', compact(
			'title',
			'lists'
		));
	}

	public function detail($slug=''){
		$all = (new CrudRepository('project'))->filter([
			['is_active', '=', 1]
		]);

		$data = null;
		$current = $n = 0;
		foreach($all as $row){
			$n++;
			if($row->slug == $slug){
				$data = $row;
				$current = $n;
			}
			else{
				$lists[$n] = $row->slug;
			}
		}

		if(empty($data) || $current == 0){
			abort(404);
		}

		$prev = $current - 1;
		if($prev <= 0){
			$prev = $n;
		}
		$prev = $lists[$prev];

		$next = $current + 1;
		if($next > $n){
			$next = 1;
		}
		$next = $lists[$next];

		$title = $data->title;
		return view('site::project-detail', compact(
			'data',
			'title',
			'prev',
			'next',
			'slug'
		));
	}

}