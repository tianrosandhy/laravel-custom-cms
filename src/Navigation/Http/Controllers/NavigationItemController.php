<?php
namespace Module\Navigation\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Module\Main\Http\Repository\CrudRepository;
use ImageService;
use Module\Main\Http\Controllers\AdminBaseController;

class NavigationItemController extends AdminBaseController
{

	public function repo(){
		return 'navigation';
	}


	public function index(){
		$title = 'Navigation Management';
		$navigation = $this->repo->with('lists')->all();

		return view('navigation::items', compact(
			'title',
			'navigation'
		));
	}

	


	public function create($group_id=null, $item_id=null){
		if(!empty($group_id)){
			$cek = $this->repo->with('lists')->show($group_id, 'id');
			if(empty($cek)){
				abort(404);
			}
		}
		else{
			abort(404);
		}

		$group = $cek;
		if(!empty($item_id)){
			$item = $cek->lists->where('id', $item_id)->first();
		}
		else{
			$item = null;
		}

		$parent_list = (new CrudRepository('navigation_item'))->filter([
			['parent', '=', 0]
		], 'sort_no', 0, 0, 'ASC');


		//list post category, post, dan page
		$list['category'] = (new CrudRepository('category'))->all();
		$list['post'] = (new CrudRepository('post'))->filter([
			['is_active', '=', 1]
		]);
		$list['page'] = (new CrudRepository('page'))->filter([
			['is_active', '=', 1]
		]);



		return view('navigation::edit-add', compact(
			'group_id',
			'item_id',
			'group',
			'item',
			'parent_list',
			'list'
		));
	}

	public function store(){
		$validate = Validator::make($this->request->all(), [
			'group_id' => 'required',
			'item_id' => 'present',
			'title' => 'required',
			'type' => 'required',
		]);


		if($validate->fails()){
			return [
				'type' => 'error',
				'message' => $validate->messages()->first()
			];
		}

		$group = $this->repo->show($this->request->group_id);
		if(empty($group)){
			return [
				'type' => 'error',
				'message' => 'Navigation group ID not found'
			];
		}

		if($this->request->type == 'route'){
			if(strlen($this->request->parameter) > 0 && json_decode($this->request->parameter) == false){
				return [
					'type' => 'Error',
					'message' => 'Invalid JSON route parameter specified. Please retype with correct JSON format'
				];
			}
		}

		//selebihnya aman, cek kondisi form sedang CREATE / UPDATE
		if(empty($this->request->item_id)){
			self::storeNavigation();
		}
		else{
			$cek = (new CrudRepository('navigation_item'))->filterFirst([
				['id', '=', $this->request->item_id],
				['group_id', '=', $this->request->group_id]
			]);

			if(empty($cek)){
				return [
					'type' => 'error',
					'message' => 'Navigation item not found'
				];
			}

			self::updateNavigation();
		}

		session()->flash('success', 'Navigation data has been saved');
		return [
			'type' => 'success',
			'message' => 'Navigation data has been saved'
		];
	}


	protected function storeNavigation(){
		$data = self::getValue();
		(new CrudRepository('navigation_item'))->insert($data);
	}

	protected function updateNavigation(){
		$data = self::getValue();
		(new CrudRepository('navigation_item'))->update($this->request->item_id, $data);
	}


	protected function getValue(){
		$post = self::getValueByType();
		$post['group_id'] = $this->request->group_id;
		$post['title'] = $this->request->title;
		$post['type'] = $this->request->type;
		$post['icon'] = $this->request->icon;
		$post['new_tab'] = $this->request->new_tab;
		$post['sort_no'] = $this->request->sort_no;
		$post['parent'] = $this->request->parent ? $this->request->parent : 0;
		
		return $post;
	}

	protected function getValueByType(){
		$type = $this->request->type;
		if($type == 'url'){
			return [
				'url' => $this->request->url,
				'route' => '',
				'parameter' => ''
			];
		}
		else if($type == 'route'){
			return [
				'url' => '',
				'route' => $this->request->route,
				'parameter' => $this->request->parameter
			];
		}
		else{
			//bukan URL fix dan bukan route, artinya antara page, post, dan category
			return [
				'url' => '',
				'route' => '',
				'parameter' => '',
				'category_slug' => ($type == 'post-category') ? $this->request->post_category : '',
				'post_slug' => ($type == 'post') ? $this->request->posts : '',
				'page_slug' => ($type == 'page') ? $this->request->page : ''
			];
		}
	}



	public function reorder(){
		$group = $this->request->group_id;
		$data = $this->repo->show($group);
		if(empty($data)){
			abort(404);
		}

		$order_data = json_decode($this->request->order_data, true);
		if(!$order_data){
			return [
				'type' => 'error',
				'message' => 'Invalid or empty order data'
			];
		}

		$a = 0;
		foreach($order_data as $first){
			(new CrudRepository('navigation_item'))->update($first['id'], [
				'sort_no' => $a,
				'parent' => 0
			]);
			$a++;

			if(isset($first['children'])){
				$b = 0;
				foreach($first['children'] as $second){
					(new CrudRepository('navigation_item'))->update($second['id'], [
						'sort_no' => $b,
						'parent' => $first['id']
					]);
					$b++;

					if(isset($second['children'])){
						$c = 0;
						foreach($second['children'] as $third){
							(new CrudRepository('navigation_item'))->update($third['id'], [
								'sort_no' => $c,
								'parent' => $second['id']
							]);
							$c++;							
						}
					}

				}
			}
		}

		return [
			'type' => 'success',
			'message' => 'Navigation has been ordered'
		];
	}





	public function delete($id=0){
		$repo = new CrudRepository('navigation_item');
		if(!$repo->exists($id)){
			abort(404);
		}

		//hapus sekalian sama children2nya
		$instance = $repo->show($id);

		self::removeByParent($id);

		return [
			'type' => 'success',
			'message' => 'Navigation data has been deleted'
		];
	}

	protected function removeByParent($id=0){
		if($id == 0)
			return false;

		$repo = new CrudRepository('navigation_item');
		$repo->delete($id); //hapus dulu

		//terus difilter anak2nya
		$filter = $repo->filter([
			['parent', '=', $id]
		]);
		foreach($filter as $row){
			self::removeByParent($row->id);
		}
	}

}