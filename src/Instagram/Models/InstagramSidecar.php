<?php
namespace Module\Instagram\Models;

use Illuminate\Database\Eloquent\Model;
use Module\Main\Transformer\Resizeable;

class InstagramSidecar extends Model
{
	use Resizeable;

    protected $fillable = [
    ];

}
