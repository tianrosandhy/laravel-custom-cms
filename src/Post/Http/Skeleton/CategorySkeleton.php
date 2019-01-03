<?php
namespace Module\Post\Http\Skeleton;

use Module\Main\DataTable\DataTable;
use DataStructure;
use DataSource;

class CategorySkeleton extends DataTable
{

	//MANAGE STRUKTUR DATA KOLOM DAN FORM
	public function __construct(){
		$this->request = request();
		//default fields
		$this->setModel('category');


		$this->structure[] = DataStructure::field('order')
			->name('Order')
			->formColumn(12)
			->searchable(false)
			->inputType('number');

		$this->structure[] = DataStructure::field('name')
			->name('Category Name')
			->formColumn(12)
			->createValidation('required', true); //true = updatenya persis sama

		$this->structure[] = DataStructure::field('slug')
			->name('Slug')
			->formColumn(12)
			->inputType('slug')
			->slugTarget('name')
			->createValidation('required', true);
	}


	public function rowFormat($row, $as_excel=false){
		return [
			'name' => $row->name,
			'slug' => $row->slug,
			'order' => $row->order,
			'action' => self::editButton($row) . self::deleteButton($row)
		];
	}
	
	protected function editButton($row){
		if(has_access('admin.category.update')){
			return $this->actionButton(
				'Edit', 
				url()->route('admin.category.edit', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-info edit-btn'],
					'data-id' => $row->id
				]
			);
		}
	}

	protected function deleteButton($row){
		if(has_access('admin.category.delete')){
			return $this->actionButton(
				'Delete', 
				url()->route('admin.category.delete', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-danger delete-button'],
					'data-id' => $row->id
				]
			);
		}
	}



}