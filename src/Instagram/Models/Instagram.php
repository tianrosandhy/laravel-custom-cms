<?php
namespace Module\Instagram\Models;

use Illuminate\Database\Eloquent\Model;
use Module\Main\Transformer\Resizeable;

class Instagram extends Model
{
	use Resizeable;

    protected $fillable = [
    ];

}
