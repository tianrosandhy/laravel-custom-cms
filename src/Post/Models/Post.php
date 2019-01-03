<?php
namespace Module\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Module\Main\Transformer\Translator;
use Module\Main\Transformer\Resizeable;

class Post extends Model
{
    use Translator;
    use Resizeable;
    
    //
    protected $fillable = [
    	'title',
    	'slug',
    	'tags',
    	'excerpt',
    	'body',
    	'image',
    	'is_active',
    	'featured',
    	'click'
    ];

    public function categories(){
    	return $this->hasMany('Module\Post\Models\PostToCategory', 'post_id');
    }

    public function related(){
    	return $this->hasMany('Module\Post\Models\PostRelated', 'post_source');
    }

    public function comment(){
        return $this->hasMany('Module\Post\Models\PostComment', 'id_post');
    }

    public function likes(){
        return $this->hasMany('Module\Post\Models\PostLike', 'id_post');
    }

}
