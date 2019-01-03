<?php
namespace Module\Download\Http\Controllers;

use Module\Main\Http\Repository\CrudRepository;
use Module\Main\Http\Controllers\AdminBaseController;
use Module\Download\Http\Skeleton\DownloadSkeleton;
use Module\Main\Transformer\Exportable;

class DownloadController extends AdminBaseController
{
	use Exportable;
	public $hint = 'download';

	public function repo(){
		//mendefinisikan repo / model apa yang ingin digunakan
		//inputan berupa inisial sesuai yang didaftarkan di config('model')
		return $this->hint;
	}

	public function skeleton(){
		return new DownloadSkeleton;
	}

	public function languageData(){
		return [
			'index.title' => 'Download Data',
			'create.title' => 'Add New Download',
			'edit.title' => 'Edit Download Data',

			'store.success' => 'Download data has been saved',
			'update.success' => 'Download data has been updated',
			'delete.success' => 'Download data has been deleted',
		];
	}

	public function index(){
		$datatable = $this->skeleton;
		$title = self::usedLang('index.title');
		$hint = $this->hint();

		return view('download::index', compact(
			'title',
			'hint',
			'datatable'
		));
	}

	public function reset(){
		$all_data = (new CrudRepository($this->hint))->all();
		foreach($all_data as $row){
			$row->url = str_random(37);
			$row->save();
		}

		return back()->with(['success' => 'Download URL has been resetted']);
	}

	/*
	Method ini dipanggil setelah data di-insert/update, 
	Apabila membutuhkan action tambahan (manage relasi, input data type array, dsb)
	Inputan parameter berupa model eloquent data ybs
	*/
	public function afterCrud($instance){
		$instance->url = md5(encrypt(uniqid() . time()));
		$instance->hashcode = md5(encrypt(time().uniqid()));
		$instance->save();
	}


	/*
	Register kolom image yang digunakan, supaya dapat dihapus ketika ditrigger.
	Method boleh dihapus
	Default : [image]
	*/
	public function image_field(){
		return ['image'];
	}

}