<?php
namespace Module\Banner\Models;

use Illuminate\Database\Eloquent\Model;
use Module\Main\Transformer\Resizeable;

class Banner extends Model
{
	use Resizeable;
    //
    protected $fillable = [
    ];

}
