<?php
namespace Module\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Module\Main\Transformer\Resizeable;

class Project extends Model
{
    use Resizeable;
    //
    protected $fillable = [
    	'title',
    	'slug',
    	'excerpt',
    	'description',
    	'image',
    	'mobile_image',
    	'desktop_image',
    	'is_active'
    ];

}
