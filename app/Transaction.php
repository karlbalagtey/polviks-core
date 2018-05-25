<?php

namespace App;

use App\Product;
use App\Customer;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
    	'quantity',
    	'customer_id',
    	'product_id',
    ];

    public function customer() {
    	return $this->belongsTo(Customer::class);
    }

    public function product() {
    	return $this->belongsTo(Product::class);
    }
}
