<?php
namespace Module\Main\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //

    public function getUser(){
    	return $this->belongsTo('Module\Main\Models\User', 'user_id');
    }

}
