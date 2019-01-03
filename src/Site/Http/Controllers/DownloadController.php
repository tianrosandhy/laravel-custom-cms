<?php
namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Main\Http\Repository\CrudRepository;
use Storage;

class DownloadController extends Controller{

	public function __construct(Request $req){
		$this->request = $req;
		$this->hint = 'public';
	}	

	public function index($slug=''){
		//cek ketersediaan file
		$download = new CrudRepository('download');
		$download = $download->show($slug, 'slug');
		if(empty($download)){
			//file not exists or already deleted
			abort(404);
		}

		$title = 'Download ' . $download->filename;
		return view('site::download', compact(
			'title',
			'download'
		));
	}

	public function getFile($hash=''){
		$cek = new CrudRepository('download');
		$file = $cek->show($hash, 'url');
		if(empty($file)){
			abort(404);
		}

		$fname = $file->filename;

		$pathdata = json_decode($file->path, true);
		if($pathdata){
			if(Storage::exists('files/'.$pathdata['filename'])){
				self::addClick($file);
				
				if(count(explode('.', $fname)) >= 2){
					$downloaded_name = $fname;
				}
				else{
					$real_name = $pathdata['filename'];
					$pchrel = explode('.', $real_name);
					$extension = $pchrel[(count($pchrel)-1)];
					$downloaded_name = $fname.'.'.$extension;					
				}

				return response()->download(Storage::path('files/'.$pathdata['filename']), $downloaded_name);
			}

		}
		abort(404);
	}

	protected function addClick($instance){
		$hit = $instance->hit + 1;
		$instance->hit = $hit;
		$instance->save();
		return $instance;
	}

}