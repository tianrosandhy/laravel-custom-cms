<?php
namespace Module\Post\Models;

use Illuminate\Database\Eloquent\Model;

class PostToCategory extends Model
{
    //
    protected $fillable = [
    	'post_id',
    	'category_id'
    ];

    public function category(){
    	return $this->belongsTo('Module\Post\Models\Category', 'category_id');
    }

    public function post(){
    	return $this->belongsTo('Module\Post\Models\Post', 'post_id');
    }

}
