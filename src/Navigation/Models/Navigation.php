<?php
namespace Module\Navigation\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    //
    protected $fillable = [
    	'group_name',
    	'description'
    ];

    public function lists(){
    	return $this->hasMany('Module\Navigation\Models\NavigationItem', 'group_id');
    }

}
