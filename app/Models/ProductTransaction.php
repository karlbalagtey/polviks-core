<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\ProductTransactionTransformer;

class ProductTransaction extends Model
{

    use SoftDeletes;

    public $transformer = ProductTransactionTransformer::class;

    protected $dates = ['deleted_at'];
	protected $table = 'product_transactions';

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
