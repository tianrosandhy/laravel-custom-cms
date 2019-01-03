<?php
namespace Module\Navigation\Http\Skeleton;

use Module\Main\DataTable\DataTable;
use DataStructure;
use DataSource;

class NavigationSkeleton extends DataTable
{

	//MANAGE STRUKTUR DATA KOLOM DAN FORM
	public function __construct(){
		$this->request = request();
		//default fields
		$this->setModel('navigation');

		$this->structure[] = DataStructure::field('group_name')
			->name('Group Name')
			->formColumn(12)
			->createValidation('required', true); //true = updatenya persis sama

		$this->structure[] = DataStructure::field('description')
			->name('Description')
			->inputType('richtext')
			->formColumn(12);
		
	}



	
	//MANAGE OUTPUT DATATABLE FORMAT PER BARIS
	public function tableFormat(){
		$out = [];
		foreach($this->raw_data as $row){
			$out[] = [
				'group_name' => $row->group_name,
				'description' => $row->description,
				'action' => self::editButton($row) . self::deleteButton($row)
			];
		}

		$this->output = $out;
	}

	protected function editButton($row){
		if(has_access('admin.navigation.update')){
			return $this->actionButton(
				'Edit', 
				url()->route('admin.navigation.edit', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-info edit-btn'],
					'data-id' => $row->id
				]
			);
		}
	}

	protected function deleteButton($row){
		if(has_access('admin.navigation.delete')){
			return $this->actionButton(
				'Delete', 
				url()->route('admin.navigation.delete', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-danger delete-button'],
					'data-id' => $row->id
				]
			);
		}
	}



}