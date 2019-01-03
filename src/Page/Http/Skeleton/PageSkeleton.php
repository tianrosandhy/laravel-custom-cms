<?php
namespace Module\Page\Http\Skeleton;

use Module\Main\DataTable\DataTable;
use DataStructure;
use DataSource;

class PageSkeleton extends DataTable
{

	//MANAGE STRUKTUR DATA KOLOM DAN FORM
	public function __construct(){
		$this->request = request();
		//default fields
		$this->setModel('page');

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

		$this->structure[] = DataStructure::field('tags')
			->name('Tags')
			->orderable(false)
			->formColumn(12)
			->inputType('tags');

		$this->structure[] = DataStructure::field('excerpt')
			->name('Excerpt')
			->formColumn(12)
			->hideTable()
			->inputType('textarea');

		$this->structure[] = DataStructure::field('body')
			->name('Post Content')
			->formColumn(12)
			->inputType('richtext')
			->hideTable()
			->createValidation('required', true);

		$this->structure[] = DataStructure::field('image')
			->name('Image')
			->searchable(false)
			->orderable(false)
			->formColumn(12)
			->inputType('image');

		$this->structure[] = DataStructure::field('is_active')
			->name('Is Active')
			->formColumn(6)
			->inputType('radio')
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
			'tags' => $row->tags,
			'image' => '<img src="'.$row->getThumbnailUrl('image', 'thumb').'" style="height:80px">',
			'is_active' => view('main::inc.switchery', [
				'id' => $row->id, 
				'field' => 'is_active',
				'url' => admin_url('page/switch'),
				'value' => $row->is_active
			])->render(),
			'action' => self::editButton($row) . self::deleteButton($row)
		];
	}

	protected function editButton($row){
		if(has_access('admin.page.update')){
			return $this->actionButton(
				'Edit', 
				url()->route('admin.page.edit', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-info edit-btn'],
					'data-id' => $row->id
				]
			);
		}
	}

	protected function deleteButton($row){
		if(has_access('admin.page.delete')){
			return $this->actionButton(
				'Delete', 
				url()->route('admin.page.delete', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-danger delete-button'],
					'data-id' => $row->id
				]
			);
		}
	}



}