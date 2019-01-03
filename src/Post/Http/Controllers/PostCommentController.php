<?php
namespace Module\Post\Http\Controllers;

use Module\Main\Http\Repository\CrudRepository;
use Module\Main\Http\Controllers\AdminBaseController;
use Module\Post\Http\Skeleton\PostCommentSkeleton;

use Mail;
use Module\Main\Mail\MainMail;


class PostCommentController extends AdminBaseController
{
	public $hint = 'post_comment';

	public function repo(){
		return $this->hint;
	}

	public function index(){
		$datatable = $this->skeleton;
		$title = self::usedLang('index.title');
		$hint = $this->hint();

		return view('post::comment', compact(
			'title',
			'hint',
			'datatable'
		));
	}

	public function skeleton(){
		return new PostCommentSkeleton();
	}

	public function languageData(){
		return [
			'index.title' => 'Post Comment Lists',
			'create.title' => 'Add New Post Comment',
			'edit.title' => 'Edit Post Comment Data',

			'store.success' => 'Post comment data has been saved',
			'update.success' => 'Post comment data has been updated',
			'delete.success' => 'Post comment data has been deleted',
		];
	}

	
	//berlaku utk insert dan update, dipanggil setelah data disave/update. 
	public function afterCrud($instance){

	}

	public function removeSpam(){
		$data = (new CrudRepository('post_comment'))->deleteWithFilter([
			['spam', '=', 1]
		]);

		return back()->with(['success' => 'Spam message has beed removed']);
	}

	public function reply($id){
		$data = (new CrudRepository('post_comment'))->show($id);
		$val = $this->validatePostReply($data);
		if($val){
			return $val;
		}

		$title = 'Reply to Comment';
		return view('post::comment-reply', compact(
			'title',
			'data'
		));
	}

	public function postReply($id){
		$data = (new CrudRepository('post_comment'))->show($id);
		$val = $this->validatePostReply($data);
		if($val){
			return $val;
		}

		if(strlen(trim($this->request->reply)) <= 1){
			return back()->withErrors(['reply' => 'Please fill your reply']);
		}

		//if the user comment is updated, change it too..
		if(strlen($this->request->post_comment) > 0){
			$user_comment = (new CrudRepository('post_comment'))->update($id, [
				'message' => $this->request->post_comment
			]);
		}


		//if there is old admin comment, just delete it
		(new CrudRepository('post_comment'))->deleteWithFilter([
			['id_post', '=', $data->id_post],
			['reply_to', '=', $id]
		]);

		$admin_comment = (new CrudRepository('post_comment'))->insert([
			'id_post' => $data->id_post,
			'email' => setting('admin.email'),
			'last_name' => 'Administrator',
			'message' => $this->request->reply,
			'reply_to' => $id,
			'spam' => 0,
			'is_active' => 1
		]);

		if($this->request->with_email){
			//process send email to customer with job
			$mail = new MainMail();
			$mail->setTitle('Reply Comment From Administrator ');
			$mail->setSubject(setting('site.title') . ' Reply Comment From Administrator ');
			$mail->setContent('
			<strong>Your Comment </strong> : <br>'.
				(isset($admin_comment->reply->message) ? nl2br(strip_tags($admin_comment->reply->message)) : '-')
			.'
			<br>
			<strong>Article Commented</strong> : '. (isset($admin_comment->post->slug) ? $admin_comment->post->title : '-') .'
			<br>
			<br>
			<strong>Admin Reply</strong> : 
			<br>
			'. nl2br(strip_tags($admin_comment->message)) .'
			');
			$mail->setReplyTo(setting('admin.contact_mail', 'tianrosandhy@gmail.com'));
			$mail->storeToQueue($admin_comment->reply->email);
		}

		return redirect()->route('admin.post_comment.index')->with(['success' => 'Your comment has been published']);
	}

	protected function validatePostReply($data){
		if($data->is_active <> 1){
			return back()->with(['error' => 'Set comment to active first before give a reply']);
		}

		if($data->spam <> 0){
			return back()->with(['error' => 'Why are you give reply to spammed comment? -_-']);
		}

		if($data->reply_to > 0){
			return back()->with(['error' => 'You cannot reply your own comment.. :|']);
		}

		return false;
	}

}