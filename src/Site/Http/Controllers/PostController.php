<?php
namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Main\Http\Repository\CrudRepository;

class PostController extends Controller{
	use Traits\LikeComment;

	public $request;
	public $perPage = 10;

	public function __construct(Request $req){
		$this->request = $req;
	}

	public function index(){
		$data = $this->getPostByPage(1);
		$page2 = $this->getPostByPage(2);

		$sidebar = $this->getSidebarContent();

		$title = 'Articles';
		return view('site::blog-list', compact(
			'title',
			'data',
			'page2',
			'sidebar'
		));
	}

	public function lazyLoad($page=1){
		if(!$this->request->ajax()){
			abort(404);
		}

		$cat = 0;
		if($this->request->category > 0){
			$cat = intval($this->request->category);
		}

		$view = $this->getPostByPage($page, $cat);
		if(strlen(trim($view)) > 0){
			return '<div class="blog-page-wrap" data-page="'.$page.'" style="display:none;">'.$view.'</div>';
		}

		return '';
	}

	public function category($slug=''){
		$category = (new CrudRepository('category'))->show($slug, 'slug');
		if(empty($category)){
			abort(404);
		}

		$cat_id = $category->id;
		$data = $this->getPostByPage(1, $cat_id);
		$page2 = $this->getPostByPage(2, $cat_id);
		$sidebar = $this->getSidebarContent();
		$is_category = true;

		$title = $category->name;
		return view('site::blog-list', compact(
			'title',
			'data',
			'page2',
			'sidebar',
			'is_category',
			'cat_id'
		));
	}

	public function detail($slug=''){
		$data = (new CrudRepository('post'))->show($slug, 'slug');
		if(empty($data) || $data->is_active <> 1){
			abort(404);
		}

		$config = $this->createPostConfig($data);

		$title = $data->title;
		$seo = [
			'image' => $data->getThumbnailUrl('image', 'large'),
			'title' => $title,
			'description' => strlen(trim($data->excerpt)) > 0 ? $data->excerpt : descriptionMaker($data->body)
		];


		//random post for recomended articles
		$random = (new CrudRepository('post'))->model;
		$random = $random->where('is_active', 1)
			->where('slug', '<>', $slug)
			->inRandomOrder()
			->take(3)
			->get();


		return view('site::blog-detail', compact(
			'title',
			'seo',
			'data',
			'random',
			'config'
		));
	}

	public function search($keyword=''){
		$title = 'Search Result for keyword "' . $keyword.'"';

		$data = (new CrudRepository('post'))->search($keyword, ['title', 'tags', 'excerpt']);
		if(empty($data)){
			$data = (new CrudRepository('post'))->fullSearch($keyword, ['title', 'tags', 'excerpt']);
		}


		$out = '';
		foreach($data as $row){
			$out .= view('site::include.partials.blog-list-item', compact('row'))->render();
		}

		$sidebar = $this->getSidebarContent();

		return view('site::blog-search', compact(
			'title',
			'data',
			'out',
			'sidebar'
		));
	}






	protected function createPostConfig($post){
		$current_ip = $this->request->ip();

		$out['likes'] = count($post->likes);
		$out['is_liked'] = false;
		foreach($post->likes as $likes){
			if($likes->ip == $current_ip){
				$out['is_liked'] = true;
				break;
			}
		}

		return $out;
	}



	protected function getPostByPage($page=1, $category=0){
		$skip = ($page - 1) * $this->perPage;

		if($category > 0){
			$model = (new CrudRepository('post'))->model;
			$data = $model->whereHas('categories', function($qry) use($category){
					$qry->where('category_id', $category);
				})->where('is_active', 1)
				->orderBy('id', 'DESC')
				->skip($skip)
				->take($this->perPage)
				->get();
		}
		else{
			$data = (new CrudRepository('post'))->filter([
				['is_active', '=', 1]
			], 'id', $skip, $this->perPage);
		}

		$out = '';
		foreach($data as $row){
			$out .= view('site::include.partials.blog-list-item', compact('row'))->render();
		}

		return $out;
	}


	protected function getSidebarContent(){
		$recent_blog = (new CrudRepository('post'))->filter([
			['is_active', '=', 1],
		], 'created_at', 0, 3);
		$categories = (new CrudRepository('category'))->all();
		$instagram = (new CrudRepository('instagram'))->filter([
			['is_active', '=', 1]
		], 'post_created', 0, 8);

		return compact('recent_blog', 'categories', 'instagram');
	}

}