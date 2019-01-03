<?php
namespace Module\Post\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{

    public function post(){
    	return $this->belongsTo('Module\Post\Models\Post', 'id_post');
    }

    public function reply(){
    	return $this->belongsTo('Module\Post\Models\PostComment', 'reply_to');
    }

    public function commented(){
    	return $this->belongsTo('Module\Post\Models\PostComment', 'id', 'reply_to');
    }

}
