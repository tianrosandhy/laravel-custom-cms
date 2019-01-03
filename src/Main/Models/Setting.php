<?php
namespace Module\Main\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = [
    	'id_user',
    	'param',
    	'value'
    ];

}
