<?php
namespace Module\Post\Models;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{

    public function post(){
    	return $this->belongsTo('Module\Post\Models\Post', 'id_post');
    }

}
