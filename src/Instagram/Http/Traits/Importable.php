<?php
namespace Module\Instagram\Http\Traits;

use InstagramScraper\Instagram;
use InstagramScraper\Exception\InstagramNotFoundException;
use Module\Main\Http\Repository\CrudRepository;
use Image;
use Storage;
use Module\Main\Http\Repository\ImageRepository;

trait Importable
{

	public function import($id_instagram=''){
		if(strlen(trim($id_instagram)) == 0){
			return api_response('error', 'Invalid ID Instagram');
		}

		try{
			$media = (new Instagram)->getMediaById($id_instagram);
		}
		catch(InstagramNotFoundException $e){
			return api_response('error', $e->getMessage());
		}


		//cek apakah id ini sudah pernah diimport atau belum
		$testImport = (new CrudRepository('instagram'))->filterFirst([
			['instagram_id', '=', $id_instagram]
		]);

		if(!empty($testImport)){
			return api_response('error', 'Media data is already imported');
		}
		else{
			//proses import
			$main_image = $media->getImageHighResolutionUrl();
			$caption = $media->getCaption();

			//gambar dari HiRes URL disimpan ke storage
			$finalpath = $this->storeImageByUrl($main_image);
			if(!$finalpath){
				return api_response('error', 'Import failed : Cannot grab image data from Instagram server.');
			}

			//generate tags by caption
			$tags_imploded = '';
			preg_match_all("/(#\w+)/", $caption, $tags);
			if(isset($tags[0])){
				$tags_imploded = implode(', ', $tags[0]);
			}

			$main = (new CrudRepository('instagram'))->insert([
				'instagram_id' => $media->getId(),
				'shortcode' => $media->getShortCode(),
				'type' => $media->getType(),
				'link' => $media->getLink(),
				'hires_image_url' => $main_image,
				'stored_url' => $finalpath,
				'caption' => $caption,
				'likes' => $media->getLikesCount(),
				'tags' => $tags_imploded,
				'video_url' => $media->getVideoStandardResolutionUrl(),
				'video_view' => $media->getVideoViews(),
				'owner_id' => $media->getOwnerId(),
				'featured' => 0,
				'is_active' => 0,
				'post_created' => date('Y-m-d H:i:s', intval($media->getCreatedTime()))
			]);

			//cek get sidecar
			$this->insertSidecar($media, $main);

			//import selesai..
			return api_response('success', 'Import success');
		}

	}

	protected function insertSidecar($media, $main){
		$sidecar = $media->getSidecarMedias();

		foreach($sidecar as $submedia){
			$submain_image = $submedia->getImageHighResolutionUrl();
			$finalpath = $this->storeImageByUrl($submain_image);
			if(!$finalpath){
				continue;
			}

			(new CrudRepository('instagram_sidecar'))->insert([
				'instagram_id' => $main->id,
				'type' => $submedia->getType(),
				'hires_image_url' => $submain_image,
				'stored_url' => $finalpath,
				'video_url' => $media->getVideoStandardResolutionUrl(),
			]);
		}
	}

	protected function storeImageByUrl($url=''){
		$path = config('module-setting.instagram.upload_path');

		//new update from IG : URL contain get parameter checker so we cannot process like usual
		$string_data = file_get_contents($url);
		$finalpath = (new ImageRepository)->handleRawUpload($string_data, $path);

		return $finalpath;
	}


	public function removeImport($id_instagram=''){

	}


}