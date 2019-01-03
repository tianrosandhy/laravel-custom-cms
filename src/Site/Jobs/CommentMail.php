<?php
namespace Module\Site\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use Module\Main\Mail\MainMail;


class CommentMail implements ShouldQueue
{
	public $post_comment;
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public function __construct($post_comment)
  {
      //
  	$this->post_comment = $post_comment;
  }

  public function handle()
  {
  	$mail = new MainMail();
		$mail->setTitle('New Blog Comment From ' . $this->post_comment->last_name);
		$mail->setSubject('New Blog Comment From ' . $this->post_comment->last_name);
		$mail->setContent('
		<strong>Name</strong> : '.$this->post_comment->last_name.'
		<br>
		<strong>Email</strong> : '.$this->post_comment->email.'
		<br>
		<strong>Article Commented</strong> : '. (isset($this->post_comment->post->slug) ? $this->post_comment->post->title : '-') .'
		<br>
		<br>
		<strong>Message</strong> : 
		<br>
		'. nl2br(strip_tags($this->post_comment->message)) .'
		');

		$mail->setReplyTo($this->post_comment->email);
		Mail::to(setting('admin.contact_mail', 'tianrosandhy@gmail.com'))->send($mail);
  }
}
