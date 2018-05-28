<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\CategoryTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

    public $transformer = CategoryTransformer::class;

	protected $dates = ['deleted_at'];

    protected $fillable = [
    	'name',
    	'description',
    ];

    protected $hidden = ['pivot'];

    public function products()
    {
    	return $this->belongsToMany(Product::class);
    }

    public function services()
    {
    	return $this->belongsToMany(Service::class);
    }

    public function productsAndServices()
    {
    	$products = $this->products();
    	$services = $this->services();

        return $products->union($services->toBase());
    }
}
