<?php

namespace App\Models;

use App\Models\Agent;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductTransaction;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

	const AVAILABLE_PRODUCT = 'available';
	const UNAVAILABLE_PRODUCT = 'unavailable';

    public $transformer = ProductTransformer::class;
    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'name',
    	'description',
    	'quantity',
    	'status',
    	'price',
    	'image_id',
    	'agent_id',
    ];

    protected $hidden = [
        'pivot'
    ];

    public $load = ['images'];

    public function isAvailable()
    {
    	return $this->status == Product::AVAILABLE_PRODUCT;
    }

    public function agent()
    {
    	return $this->belongsTo(Agent::class);
    }

    public function transactions()
    {
    	return $this->hasMany(ProductTransaction::class);
    }

    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
