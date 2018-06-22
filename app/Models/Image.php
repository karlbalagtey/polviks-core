<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
    	'path',
    	'file',
    	'type',
    ];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function service()
    {
    	return $this->belongsTo(Service::class);
    }
}
