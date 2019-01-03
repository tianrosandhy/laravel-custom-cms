<?php
namespace Module\Instagram\Http\Traits;

use InstagramScraper\Instagram;


trait Grabable
{

	public function grab(){
		$title = 'Grab Instagram Data';
		return view('instagram::grab', compact(
			'title'
		));
	}

	public function grabProcess(){
		if($this->request->filter_by == 'tag'){
			$data = $this->grabByTag();
		}
		elseif($this->request->filter_by == 'username'){
			$data = $this->grabByUsername();
		}
		else{
			$data = $this->errorTemplate('Invalid filter type specified');
		}

		return $data;
	}

	public function loadNextGrab(){
		if($this->request->filter_by == 'tag'){
			$data = $this->grabByTag($this->request->nextId);
		}
		elseif($this->request->filter_by == 'username'){
			$data = $this->grabByUsername($this->request->nextId);
		}
		else{
			$data = $this->errorTemplate('Invalid filter type specified');
		}

		return $data;
	}




	

	protected function grabByTag($nextId=null){
		if(strlen(trim($this->request->tag)) == 0){
			return $this->errorTemplate('Please type the tag you want to filter');
		}
		$tag = trim($this->request->tag);
		$instagram = new Instagram();
		$data = $instagram->getPaginateMediasByTag($tag, $nextId);
		if($data){
			return $this->setOutput($data, $nextId);
		}
		else{
			\CMS::log($data, 'INSTAGRAM FAILED RESULT');
			return $this->errorTemplate('Sorry, we cannot contact the Instagram API');
		}
	}

	protected function grabByUsername($nextId=null){
		if(strlen(trim($this->request->username)) == 0){
			return $this->errorTemplate('Please type the username you want to filter');
		}
		$username = trim($this->request->username);

		$instagram = new Instagram();
		$data = $instagram->getPaginateMedias($username, $nextId);

		$virtualdata = $data;
		if($data){
			return $this->setOutput($data, $nextId);
		}
		else{
			\CMS::log($data, 'INSTAGRAM FAILED RESULT');
			return $this->errorTemplate('Sorry, we cannot contact the Instagram API');
		}
	}

	protected function setOutput($data, $nextId=null){

		if($nextId){
			return [
				'current' => $nextId,
				'data' => $data,
				'view' => view('instagram::partials.grab-list-inner', compact(
					'data',
					'nextId'
				))->render()
			];
		}
		else{
			return view('instagram::partials.grab-list', compact(
				'data',
				'nextId'
			));
		}
	}


}