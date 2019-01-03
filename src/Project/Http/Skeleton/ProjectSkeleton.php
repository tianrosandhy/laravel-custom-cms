<?php
namespace Module\Project\Http\Skeleton;

use Module\Main\DataTable\DataTable;
use DataStructure;
use DataSource;

class ProjectSkeleton extends DataTable
{

	//MANAGE STRUKTUR DATA KOLOM DAN FORM
	public function __construct(){
		$this->request = request();
		//default fields
		$this->setModel('project');

		$this->structure[] = DataStructure::field('title')
			->name('Title')
			->formColumn(12)
			->createValidation('required', true); //true = updatenya persis sama

		$this->structure[] = DataStructure::field('slug')
			->name('Slug')
			->formColumn(12)
			->inputType('slug')
			->slugTarget('title')
			->createValidation('required', true);


		$this->structure[] = DataStructure::field('excerpt')
			->name('Excerpt')
			->formColumn(12)
			->hideTable()
			->inputType('textarea');

		$this->structure[] = DataStructure::field('description')
			->name('Description')
			->formColumn(12)
			->inputType('richtext')
			->hideTable()
			->createValidation('required', true);

		$this->structure[] = DataStructure::field('image')
			->name('Image')
			->searchable(false)
			->orderable(false)
			->formColumn(12)
			->inputType('image')
			->setImageDirPath(config('module-setting.project.upload_path'));

		$this->structure[] = DataStructure::field('desktop_image')
			->name('Desktop Images')
			->hideTable()
			->searchable(false)
			->orderable(false)
			->formColumn(12)
			->inputType('image_multiple')
			->setImageDirPath(config('module-setting.project.upload_path'));

		$this->structure[] = DataStructure::field('mobile_image')
			->name('Mobile Images')
			->searchable(false)
			->hideTable()
			->orderable(false)
			->formColumn(12)
			->inputType('image_multiple')
			->setImageDirPath(config('module-setting.project.upload_path'));


		$this->structure[] = DataStructure::field('is_active')
			->name('Is Active')
			->formColumn(6)
			->inputType('select')
			->dataSource(DataSource::setList([
				'0' => 'Draft',
				'1' => 'Active'
			]));
		
	}



	
	//MANAGE OUTPUT DATATABLE FORMAT PER BARIS
	public function rowFormat($row, $as_excel=false){
		return [
			'title' => $row->title,
			'slug' => $row->slug,
			'excerpt' => $row->excerpt,
			'description' => $row->description,
			'image' => '<img src="'.$row->getThumbnailUrl('image', 'thumb').'" style="height:60px">',
			'is_active' => view('main::inc.switchery', [
				'id' => $row->id, 
				'field' => 'is_active',
				'url' => admin_url('project/switch'),
				'value' => $row->is_active
			])->render(),

			'action' => self::editButton($row) . self::deleteButton($row)
		];
	}

	protected function editButton($row){
		if(has_access('admin.project.update')){
			return $this->actionButton(
				'Edit', 
				url()->route('admin.project.edit', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-info edit-btn'],
					'data-id' => $row->id
				]
			);
		}
	}

	protected function deleteButton($row){
		if(has_access('admin.project.delete')){
			return $this->actionButton(
				'Delete', 
				url()->route('admin.project.delete', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-danger delete-button'],
					'data-id' => $row->id
				]
			);
		}
	}



}