<?php
namespace Module\Blank\Http\Controllers;

use Module\Main\Http\Repository\CrudRepository;
use Module\Main\Http\Controllers\AdminBaseController;
use Module\Blank\Http\Skeleton\BlankSkeleton;
use Module\Main\Transformer\Exportable;

class BlankController extends AdminBaseController
{
	use Exportable;
	public $hint = 'blank';

	public function repo(){
		//mendefinisikan repo / model apa yang ingin digunakan
		//inputan berupa inisial sesuai yang didaftarkan di config('model')
		return $this->hint;
	}

	public function skeleton(){
		return new BlankSkeleton;
	}

	public function languageData(){
		/*
		Halaman basic CRUD tergenerate dengan otomatis (source : Module/Main/Http/Traits/BasicCrud)
		manage data bahasa yang ingin digunakan di bagian ini, 
		in case butuh multi bahasa, nilai array bisa berupa multiple values
		Ex : 
		'index.title' => [
			'en' => 'Blank Data',
			'id' => 'Data Blank'
		],
		*/
		return [
			'index.title' => 'Blank Data',
			'create.title' => 'Add New Blank',
			'edit.title' => 'Edit Blank Data',

			'store.success' => 'Blank data has been saved',
			'update.success' => 'Blank data has been updated',
			'delete.success' => 'Blank data has been deleted',
		];
	}

	/*
	Method ini dipanggil setelah data di-insert/update, 
	Apabila membutuhkan action tambahan (manage relasi, input data type array, dsb)
	Inputan parameter berupa model eloquent data ybs
	*/
	public function afterCrud($instance){

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