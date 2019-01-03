<?php
namespace Module\Post\Models;

use Illuminate\Database\Eloquent\Model;

class PostRelated extends Model
{
    //
	public $table = 'post_related';

    protected $fillable = [
    	'post_source',
    	'post_related_id'
    ];

    public function source(){
    	return $this->belongsTo('Module\Post\Models\Post', 'post_source');
    }

    public function related(){
    	return $this->belongsTo('Module\Post\Models\Post', 'post_related_id');
    }

}
