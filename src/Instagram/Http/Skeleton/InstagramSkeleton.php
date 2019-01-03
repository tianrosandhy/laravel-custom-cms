<?php
namespace Module\Instagram\Http\Skeleton;

use Module\Main\DataTable\DataTable;
use DataStructure;
use DataSource;

class InstagramSkeleton extends DataTable
{

	//MANAGE STRUKTUR DATA KOLOM DAN FORM
	public function __construct(){
		$this->request = request();
		//default fields
		$this->setModel('instagram');

		$this->structure[] = DataStructure::field('instagram_id')
			->name('Instagram ID')
			->hideForm();
		$this->structure[] = DataStructure::field('link')
			->name('Instagram URL')
			->hideForm();
		$this->structure[] = DataStructure::field('type')
			->name('Type')
			->hideForm();
		$this->structure[] = DataStructure::field('stored_url')
			->name('Image')
			->hideForm();
		$this->structure[] = DataStructure::field('caption')
			->name('Caption')
			->hideForm();
		$this->structure[] = DataStructure::field('likes')
			->name('Likes')
			->hideForm();
		$this->structure[] = DataStructure::field('tags')
			->name('Tags')
			->hideForm();
		$this->structure[] = DataStructure::field('featured')
			->name('Featured')
			->hideForm();
		$this->structure[] = DataStructure::field('is_active')
			->name('Is Active')
			->hideForm();
		$this->structure[] = DataStructure::field('post_created')
			->name('Post Created')
			->hideForm();
		
	}



	
	//MANAGE OUTPUT DATATABLE FORMAT PER BARIS
	public function rowFormat($row, $as_excel=false){
		return [
            'instagram_id' => $row->instagram_id,
            'shortcode' => $row->shortcode,
            'type' => $row->type,
            'link' => '<a href="'.$row->link.'" target="_blank">'.$row->link.'</a>',
            'hires_image_url' => $row->hires_image_url,
            'stored_url' => '<img src="'.$row->getThumbnailUrl('stored_url', 'thumb').'" height=70>',
            'caption' => $row->caption,
            'likes' => $row->likes,
            'tags' => $row->tags,
            'video_url' => $row->video_url,
            'video_view' => $row->video_view,
            'owner_id' => $row->owner_id,
            'featured' => $row->featured,
            'is_active' => $as_excel ? $row->is_active : view('main::inc.switchery', [
				'id' => $row->id, 
				'field' => 'is_active',
				'url' => admin_url('instagram/switch'),
				'value' => $row->is_active
			])->render(),
            'post_created' => $row->post_created,
			'action' => self::deleteButton($row)
		];
	}

	protected function deleteButton($row){
		if(has_access('admin.instagram.delete')){
			return $this->actionButton(
				'Delete', 
				url()->route('admin.instagram.delete', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-danger delete-button'],
					'data-id' => $row->id
				]
			);
		}
	}



}