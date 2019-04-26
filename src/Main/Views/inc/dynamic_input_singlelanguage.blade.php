<?php
$default = old(str_replace('[]', '', $row->field), null);
if(!isset($default)){
	$default = null;
}
if($row->value_source){
	$default = CMS::getDefaultValue($row->value_source, (isset($data->id) ? $data->id : 0));
}
else{
	if(isset($data)){
		if(method_exists($data, 'outputTranslate')){
			foreach(available_lang(true) as $lang){
				$default = $data->outputTranslate($row->field, $lang, true);
			}
		}
		else{
			//row->field harus dibuat []nya kalo ada
			$fldnm = str_replace('[]', '', $row->field);
			$default = (isset($data->{$fldnm}) ? $data->{$fldnm} : '');
		}

	}
}
?>
{!! CMS::input($row, $default ) !!}