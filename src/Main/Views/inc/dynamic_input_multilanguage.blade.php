<?php
$default = old(str_replace('[]', '', $row->field), '');
if(!isset($default[def_lang()])){
	$default = [];
	$default[def_lang()] = '';
}

if($row->value_source){
	$default[def_lang()] = CMS::getDefaultValue($row->value_source, (isset($data->id) ? $data->id : 0));
}
else{
	if(isset($data)){
		if(method_exists($data, 'outputTranslate')){
			foreach(available_lang(true) as $lang){
				$default[$lang] = $data->outputTranslate($row->field, $lang, true);
			}
		}
		else{
			//row->field harus dibuat []nya kalo ada
			$fldnm = str_replace('[]', '', $row->field);
			$default[def_lang()] = (isset($data->{$fldnm}) ? $data->{$fldnm} : '');
		}

	}
}
?>
{!! CMS::inputMultilang($row, $default ) !!}