<?php
namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Main\Http\Repository\CrudRepository;

class PageController extends Controller{
	public $request;

	public function __construct(Request $req){
		$this->request = $req;
	}

	public function index($slug=''){
		$data = (new CrudRepository('page'))->show($slug, 'slug');
		if(empty($data)){
			abort(404);
		}

		dd($data);
	}


}