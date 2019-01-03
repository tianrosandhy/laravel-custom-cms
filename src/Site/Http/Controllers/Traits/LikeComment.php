<?php
namespace Module\Site\Http\Controllers\Traits;

use Module\Main\Http\Repository\CrudRepository;
use Mail;
use Module\Main\Mail\MainMail;

trait LikeComment
{


	public function likeHandle($id, $nonce){
		$nonceChecker = $this->idNonceChecker($id, $nonce);
		if($nonceChecker){
			return $nonceChecker;
		}

		//next check action request
		$action = $this->request->action;
		$ip = $this->request->ip();
		if($action == 'like'){
			(new CrudRepository('post_like'))->insert([
				'id_post' => $id,
				'ip' => $ip
			]);

			return [
				'type' => 'success',
				'action' => 'like',
			];
		}
		else{
			$filter = (new CrudRepository('post_like'))->deleteWithFilter([
				['id_post','=', $id],
				['ip', '=', $ip]
			]);

			return [
				'type' => 'success',
				'action' => 'dislike'
			];
		}

	}


	public function commentHandle($id){
		$nonce = $this->request->nonce;
		$nonceChecker = $this->idNonceChecker($id, $nonce);
		if($nonceChecker){
			return $nonceChecker;
		}

		$validate = \Validator::make($this->request->all(), [
			'last_name' => 'required',
			'email' => 'required|strict_mail|email',
			'comment' => 'required|min:10'
		],[
			'last_name.required' => 'Please fill your name'
		]);

		if($validate->fails()){
			return [
				'type' => 'error',
				'message' => $validate->errors()->first()
			];
		}


		$spam_validator = \Validator::make($this->request->all(), [
			'username' => 'honeypot',
			'first_name' => 'honeypot',
			'website' => 'honeypot'
		], [
			'username.honeypot' => 'Hidden input "username" filled',
			'first_name.honeypot' => 'Hidden input "first_name" filled',
			'website.honeypot' => 'Hidden input "website" filled',
		]);

		$spam = 0;
		$spam_reason = null;
		if($spam_validator->fails()){
			//insert message to spam
			$spam = 1;
			$spam_reason = $spam_validator->errors()->first();
		}

		if(strlen($this->request->comment) <> strlen(strip_tags($this->request->comment))){
			$spam = 1;
			$spam_reason = 'HTML tags in message field';
		}


		//just save even if it spam
		$insert = (new CrudRepository('post_comment'))->insert([
			'id_post' => $id,
			'email' => $this->request->email,
			'first_name' => $this->request->first_name,
			'last_name' => $this->request->last_name,
			'message' => $this->request->comment,
			'spam' => $spam,
			'spam_reason' => $spam_reason,
			'is_active' => 0
		]);

		if(!$spam){
			//create email job notification to me
	  	$mail = new MainMail();
			$mail->setTitle('New Blog Comment From ' . $insert->last_name);
			$mail->setSubject('New Blog Comment From ' . $insert->last_name);
			$mail->setContent('
			<strong>Name</strong> : '.$insert->last_name.'
			<br>
			<strong>Email</strong> : '.$insert->email.'
			<br>
			<strong>Article Commented</strong> : '. (isset($insert->post->slug) ? $insert->post->title : '-') .'
			<br>
			<br>
			<strong>Message</strong> : 
			<br>
			'. nl2br(strip_tags($insert->message)) .'
			');

			$mail->setReplyTo($insert->email);
			$mail->storeToQueue(setting('admin.contact_mail', 'tianrosandhy@gmail.com'));
		}

		return [
			'type' => 'success',
			'message' => 'Thank you, your comment has been sent. We will moderate it first before show it here',
		];

	}


	protected function idNonceChecker($id, $nonce){
		//check credibility
		try{
			$idcek = decrypt($nonce);
		}catch(\Exception $e){
			$idcek = 0;
		}

		if($id <> $idcek){
			return [
				'type' => 'error',
				'message' => 'Invalid input parameter specified'
			];
		}

		$cek = (new CrudRepository('post'))->show($id);
		if(empty($cek)){
			return [
				'type' => 'error',
				'message' => 'Post data not found'
			];
		}
		if($cek->is_active != 1){
			return [
				'type' => 'error',
				'message' => 'Post data is not available at the moment'
			];
		}

		return false;
	}


}