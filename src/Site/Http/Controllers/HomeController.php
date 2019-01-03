<?php
namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Main\Http\Repository\CrudRepository;
use Mail;
use Module\Main\Mail\MainMail;

class HomeController extends Controller{
	public $request;

	public function __construct(Request $req){
		$this->request = $req;
	}



	public function index(){
		$homepage = true;

		$post = (new CrudRepository('post'))->filter([
			['is_active', '=', 1],
			['featured', '=', 1],
		], 'click', 0, 3);

		$project = (new CrudRepository('project'))->filter([
			['is_active', '=', 1]
		]);

		$slider = (new CrudRepository('banner'))->filter([
			['is_active', '=', 1]
		], 'title', 0, 10, 'ASC');

		$seo['description'] = setting('site.description');
		return view('site::index', compact(
			'homepage',
			'seo',
			'post',
			'project',
			'slider'
		));
	}


	public function contact(){
		$title = 'Contact Us';
		return view('site::contact', compact(
			'title'
		));
	}

	public function contactProcess(){
		$ccek = \Validator::make($this->request->all(), [
			'email' => 'required|email',
			'message' => 'required'
		]);

		if($ccek->fails()){
			return [
				'type' => 'error',
				'message' => $ccek->messages()->first()
			];
		}

		//validate spam
		$spam_reason = false;
		$spamcek = \Validator::make($this->request->all(), [
			'username' => 'honeypot',
			'first_name' => 'honeypot',
			'timestamp' => 'honeytime'
		]);
		if($spamcek->fails()){
			$spam_reason = $spamcek->messages()->first();
		}
		if(strlen($this->request->message) <> strlen(strip_tags($this->request->message))){
			$spam_reason = 'Message contain HTML';
		}
		if(strlen($this->request->message) < 10){
			$spam_reason = 'Message too short';
		}


		

		if($spam_reason){
			//log to SPAM log
			\CMS::log($this->request->all(), 'CONTACT EMAIL SPAM : '.$spam_reason);
		}
		else{
			//kirim dah
	  	$sender_name = strlen($this->request->last_name) == 0 ? 'No Name' : strip_tags($this->request->last_name);

	  	$mail = new MainMail();
			$mail->setTitle('New Message from Website');
			$mail->setSubject('New Message from ' . setting('site.title'));
			$mail->setContent('
			<strong>Name</strong> : '.$sender_name.'
			<br>
			<strong>Email</strong> : '.$this->request->email.'
			<br>
			<strong>Phone</strong> : '.(strlen($this->request->phone) > 0 ? $this->request->phone : '-').'
			<br>
			<br>
			<strong>Message</strong> : 
			<br>
			'. nl2br(strip_tags($this->request->message)) .'
			');

			$mail->setReplyTo($this->request->email);
			$mail->storeToQueue(setting('admin.contact_mail', 'tianrosandhy@gmail.com'));
		}

		return [
			'type' => 'success',
			'message' => 'Thank you, your message has been sent. We will reply it soon.'
		];

	}

}