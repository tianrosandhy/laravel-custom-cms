<?php
namespace Module\Project\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Module\Main\Http\Repository\CrudRepository;
use ImageService;
use Module\Main\Http\Controllers\AdminBaseController;

use Module\Project\Http\Skeleton\ProjectSkeleton;
use Module\Main\Transformer\Exportable;
use DB;

class ProjectController extends AdminBaseController
{
	use Exportable;
	public $hint = 'project';

	public function repo(){
		return $this->hint;
	}

	public function skeleton(){
		return new ProjectSkeleton;
	}

	public function languageData(){
		return [
			'index.title' => 'Project Data',
			'create.title' => 'Add New Project',
			'edit.title' => 'Edit Project Data',

			'store.success' => 'Project data has been saved',
			'update.success' => 'Project data has been updated',
			'delete.success' => 'Project data has been deleted',
		];
	}

	public function image_field(){
		return ['image', 'desktop_image', 'mobile_image'];
	}

	public function afterCrud($instance){
		//dibuat manual karena tipe datanya input image multiple
		$instance->desktop_image = $this->request->desktop_image;
		$instance->mobile_image = $this->request->mobile_image;
		$instance->save();
	}

}