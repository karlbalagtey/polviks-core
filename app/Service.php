<?php

namespace App;

use App\Agent;
use App\Category;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	const AVAILABLE_PRODUCT = 'available';
	const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $fillable = [
    	'name',
    	'description',
    	'quantity',
    	'status',
    	'price',
    	'image_id',
    	'agent_id',
    ];

    public function isAvailable()
    {
    	return $this->status == Service::AVAILABLE_PRODUCT;
    }

    public function agent()
    {
    	return $this->belongsTo(Agent::class);
    }

    public function transactions()
    {
    	return $this->hasMany(Transaction::class);
    }

    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }
}
