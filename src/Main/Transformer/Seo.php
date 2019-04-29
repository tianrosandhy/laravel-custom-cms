<?php
namespace Module\Main\Transformer;

trait Seo
{
	public function seoFields($data=null){
		if(empty($data)){
			$data = $this->repo->model;
		}
		return view('main::additional-seo', compact(
			'data'
		));
	}

	public function storeSeo($instance){
		$table = $instance->getTable();

		//manage SEO json data
		$seo = [];
		foreach(available_lang(true) as $dl){
			$seo[$dl]['title'] = isset($this->request->seo_title[$dl]) ? $this->request->seo_title[$dl] : '';
			$seo[$dl]['keyword'] = isset($this->request->seo_keyword[$dl]) ? $this->request->seo_keyword[$dl] : '';
			$seo[$dl]['description'] = isset($this->request->seo_description[$dl]) ? $this->request->seo_description[$dl] : '';
			$seo[$dl]['image'] = isset($this->request->seo_image) ? $this->request->seo_image : '';
		}

		//store SEO default language data
		if(isset($seo[def_lang()])){
			$instance->seo = json_encode($seo[def_lang()]);
			$instance->save();
		}

		//store translatable SEO language data if translateable is enabled
		if(config('cms.lang.active') && method_exists($instance, 'outputTranslate')){
			foreach(available_lang() as $lang){
				if(isset($seo[$lang])){
					$this->insertLanguage($lang, $table, 'seo', $instance->id, json_encode($seo[$lang]));
				}
			}
		}

	}

	public function generateSeoTags($instance, $config=[]){
		if(method_exists($this, 'outputTranslate') && config('cms.lang.active')){
			$seo = $instance->outputTranslate('seo');
		}
		else{
			$seo = $instance->seo;
		}

		$config = array_merge($config, config('seo.default'));
		$seo = json_decode($seo, true);
		if($seo){
			$config = array_merge($config, $seo);
		}
		return view('main::inc.seo', compact('config'))->render();
	}
}
