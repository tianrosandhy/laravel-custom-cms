<?php
namespace Module\Post\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
    	'name',
    	'slug',
    	'order'
    ];

    public function posts(){
    	return $this->hasMany('Module\Post\Models\PostToCategory', 'category_id');
    }

}
