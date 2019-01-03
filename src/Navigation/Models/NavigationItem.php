<?php
namespace Module\Navigation\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    //
    protected $fillable = [
    	'group_id',
    	'title',
    	'type',
    	'url',
    	'route',
    	'parameter',
        'category_slug',
        'post_slug',
        'page_slug',
    	'icon',
    	'new_tab',
        'sort_no',
        'parent'
    ];

    public function owner(){
    	return $this->belongsTo('Module\Navigation\Models\Navigation', 'group_id');
    }

    public function children(){
        return $this->hasMany('Module\Navigation\Models\NavigationItem', 'parent');
    }
}
