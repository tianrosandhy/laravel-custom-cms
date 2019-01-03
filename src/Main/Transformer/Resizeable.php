<?php
namespace Module\Main\Transformer;

use Storage;

trait Resizeable
{
	//MULTIPLE IMAGE
	public function getThumbnails($field, $thumb=''){
		$images_data = $this->{$field};
		if(strlen($images_data) == 0){
			return false;
		}

		if(strlen($thumb) == 0){
			$thumb = 'origin';
		}

		//exploder = |
		$pecah = explode("|", $images_data);
		$out = [];
		foreach($pecah as $gambar){
			$out[] = thumbnail($gambar, $thumb);
		}

		return $out;
	}

	public function getThumbnailsUrl($field, $thumb='', $fallback=true){
		$data = $this->getThumbnails($field, $thumb);
		$out = [];
		if(!$data){
			if($fallback){
				$out['origin'] = asset('maxsol/img/broken-image.jpg');
			}
			else{
				return false;
			}
			return $out;
		}
		foreach($data as $key => $row){
			if(Storage::exists($row)){
				$out[$key] = Storage::url($row);
			}
			else{
				if($fallback){
					$out[$key] = asset('maxsol/img/broken-image.jpg');
				}
				else{
					$out[$key] = false;
				}
			}
		}
		return $out;
	}



	//SINGLE IMAGE
	public function getThumbnail($field, $thumb=''){
		$image_data = $this->{$field};
		if(strlen($image_data) == 0){
			return false;
		}

		if(strlen($thumb) == 0){
			$thumb = 'origin';
		}

		return thumbnail($image_data, $thumb);
	}

	public function getThumbnaiLUrl($field, $thumb='', $fallback=true){
		$thumb = $this->getThumbnail($field, $thumb);
		if(Storage::exists($thumb)){
			$url = Storage::url($thumb);
			return str_replace("\\", '/', $url);
		}
		else{
			if($fallback){
				return asset('maxsol/img/broken-image.jpg');
			}
		}
		return false;
	}

}