<?php
namespace Module\Post\Http\Skeleton;

use Module\Main\DataTable\DataTable;
use DataStructure;
use DataSource;

class PostCommentSkeleton extends DataTable
{

	//MANAGE STRUKTUR DATA KOLOM DAN FORM
	public function __construct(){
		$this->request = request();
		//default fields
		$this->setModel('post_comment');

		$this->structure[] = DataStructure::field('created_at')
			->name('Created At')
			->hideForm()
			->inputType('date');

		$this->structure[] = DataStructure::field('id_post')
			->name('Post Commented')
			->formColumn(12)
            ->createValidation('required', true)
            ->inputType('select')
            ->dataSource(DataSource::model('post')->options('title'));

		$this->structure[] = DataStructure::field('email')
			->name('User Email')
			->formColumn(12)
			->inputType('email')
			->createValidation('required', true);

        $this->structure[] = DataStructure::field('last_name')
			->name('Name')
			->formColumn(12);

		$this->structure[] = DataStructure::field('message')
			->name('Message')
			->formColumn(12)
            ->inputType('textarea');
            
        $this->structure[] = DataStructure::field('reply_to')
            ->name('Admin Reply')
            ->formColumn(12)
            ->inputType('select')
            ->dataSource(DataSource::model('post_comment')->options('email', [
                ['reply_to', '<', 1]
            ]));

		$this->structure[] = DataStructure::field('spam')
			->name('Is Spam')
			->formColumn(6)
            ->inputType('select')
            ->dataSource(DataSource::setList([
                0 => 'No',
                1 => 'Yes'
            ]));

		$this->structure[] = DataStructure::field('is_active')
			->name('Is Active')
			->formColumn(6)
			->inputType('radio')
			->dataSource(DataSource::setList([
				'0' => 'Draft',
				'1' => 'Active'
			]));
		
	}


	public function rowFormat($row, $as_excel=false){
		if($row->reply_to == 0){
			return [
				'id_post' => '<a href="'.url()->route('front.post.detail', ['slug' => $row->post->slug]).'" target="_blank">'.$row->post->title.'</a>',
				'email' => $row->email,
				'first_name' => $row->first_name,
				'last_name' => $row->last_name,
				'message' => strip_tags($row->message),
				'reply_to' => ($row->commented) ? $row->commented->message : '-',
				'is_active' => $as_excel ? $row->is_active : view('main::inc.switchery', [
					'id' => $row->id, 
					'field' => 'is_active',
					'url' => admin_url('post_comment/switch'),
					'value' => $row->is_active
				])->render(),
				'spam' => ($row->spam == 0) ? '-' : '<strong title="'.$row->spam_reason.'">Spam</strong>',
				'created_at' => $as_excel ? $row->created_at : date('d F Y H:i:s', strtotime($row->created_at)),
				'action' => self::editButton($row) . self::deleteButton($row) . self::replyButton($row)
			];
		}
	}

	protected function replyButton($row){
		if(has_access('admin.post_comment.reply')){
			if(empty($row->reply_to)){
				return $this->actionButton(
					'Reply',
					url()->route('admin.post_comment.reply', ['id' => $row->id]),
					[
						'class' => ['btn', 'btn-sm', 'btn-warning']
					]
				);
			}
		}
	}
	

	protected function editButton($row){
		if(has_access('admin.post_comment.update')){
			return $this->actionButton(
				'Edit', 
				url()->route('admin.post_comment.edit', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-info edit-btn'],
					'data-id' => $row->id
				]
			);
		}
	}

	protected function deleteButton($row){
		if(has_access('admin.post_comment.delete')){
			return $this->actionButton(
				'Delete', 
				url()->route('admin.post_comment.delete', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-danger delete-button'],
					'data-id' => $row->id
				]
			);
		}
	}


}