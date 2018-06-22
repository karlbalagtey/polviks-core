<?php

namespace App\Models;

use App\Models\Agent;
use App\Models\Category;
use App\Models\ServiceTransaction;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\ServiceTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
	
    const AVAILABLE_SERVICE = 'available';
	const UNAVAILABLE_SERVICE = 'unavailable';

    public $transformer = ServiceTransformer::class;
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

    public function isAvailable()
    {
    	return $this->status == Service::AVAILABLE_SERVICE;
    }

    public function agent()
    {
    	return $this->belongsTo(Agent::class);
    }

    public function transactions()
    {
    	return $this->hasMany(ServiceTransaction::class);
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
