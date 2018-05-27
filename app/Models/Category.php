<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
    	'name',
    	'description',
    ];

    public function products()
    {
    	return $this->belongsToMany(Product::class);
    }

    public function services()
    {
    	return $this->belongsToMany(Service::class);
    }
}
