<?php
namespace Module\Download\Http\Skeleton;

use Module\Main\DataTable\DataTable;
use DataStructure;
use DataSource;

class DownloadSkeleton extends DataTable
{

	//MANAGE STRUKTUR DATA KOLOM DAN FORM
	public function __construct(){
		$this->request = request();
		//default fields
		$this->setModel('download');

		$this->structure[] = DataStructure::field('filename')
			->name('Filename')
			->formColumn(12)
			->createValidation('required', true); //true = updatenya persis sama

		$this->structure[] = DataStructure::field('slug')
			->name('Slug')
			->formColumn(12)
			->inputType('slug')
			->slugTarget('filename');

		$this->structure[] = DataStructure::field('url')
			->name('URL')
			->formColumn(12)
			->hideForm();

		$this->structure[] = DataStructure::field('path')
			->name('Uploaded File')
			->formColumn(12)
			->inputType('file');
		
	}



	
	//MANAGE OUTPUT DATATABLE FORMAT PER BARIS
	public function rowFormat($row, $as_excel=false){
		return [
			'filename' => $row->filename,
			'slug' => $row->slug,
			'url' => $row->url,
			'hit' => $row->hit,
			'path' => $row->path,
			'action' => self::editButton($row) . self::deleteButton($row)
		];
	}

	protected function editButton($row){
		if(has_access('admin.download.update')){
			return $this->actionButton(
				'Edit', 
				url()->route('admin.download.edit', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-info edit-btn'],
					'data-id' => $row->id
				]
			);
		}
	}

	protected function deleteButton($row){
		if(has_access('admin.download.delete')){
			return $this->actionButton(
				'Delete', 
				url()->route('admin.download.delete', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-danger delete-button'],
					'data-id' => $row->id
				]
			);
		}
	}



}