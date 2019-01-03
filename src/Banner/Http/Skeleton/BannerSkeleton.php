<?php
namespace Module\Banner\Http\Skeleton;

use Module\Main\DataTable\DataTable;
use DataStructure;
use DataSource;

class BannerSkeleton extends DataTable
{

	//MANAGE STRUKTUR DATA KOLOM DAN FORM
	public function __construct(){
		$this->request = request();
		//default fields
		$this->setModel('banner');

		$this->structure[] = DataStructure::field('title')
			->name('Title')
			->inputType('textarea')
			->formColumn(12)
			->createValidation('required', true); //true = updatenya persis sama

		$this->structure[] = DataStructure::field('description')
			->name('Description')
			->inputType('textarea')
			->formColumn(12);

		$this->structure[] = DataStructure::field('image')
			->name('Image Desktop')
			->inputType('image')
			->formColumn(12)
			->hideTable()
			->hideForm()
			->setImageDirPath(config('module-setting.banner.upload_path'));
			
		$this->structure[] = DataStructure::field('image_mobile')
			->name('Image Mobile')
			->inputType('image')
			->formColumn(12)
			->hideTable()
			->hideForm()
			->setImageDirPath(config('module-setting.banner.upload_path'));
		
		$this->structure[] = DataStructure::field('type')
			->name('Banner Type')
			->inputType('select')
			->dataSource(DataSource::setList(config('banner.type')))
			->formColumn(12);
			
		$this->structure[] = DataStructure::field('is_active')
			->name('Is Active')
			->inputType('select')
			->dataSource(DataSource::setList([
				0 => 'Draft',
				1 => 'Live'
			]))
			->formColumn(12);
		
	}



	public function rowFormat($row, $as_excel=false){
		return [
			'title' => $row->title,
			'description' => $row->description,
			'image' => '<img height=60 src="'.$row->getThumbnailUrl('image', 'thumb').'">',
			'image_mobile' => '<img height=60 src="'.$row->getThumbnailUrl('image_mobile', 'thumb').'">',
			'type' => config('banner.type')[$row->type],
			'is_active' => view('main::inc.switchery', [
				'id' => $row->id, 
				'field' => 'is_active',
				'url' => admin_url('banner/switch'),
				'value' => $row->is_active
			])->render(),
			'action' => self::editButton($row) . self::deleteButton($row)
		];
	}

	protected function editButton($row){
		if(has_access('admin.banner.update')){
			return $this->actionButton(
				'Edit', 
				url()->route('admin.banner.edit', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-info edit-btn'],
					'data-id' => $row->id
				]
			);
		}
	}

	protected function deleteButton($row){
		if(has_access('admin.banner.delete')){
			return $this->actionButton(
				'Delete', 
				url()->route('admin.banner.delete', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-danger delete-button'],
					'data-id' => $row->id
				]
			);
		}
	}



}