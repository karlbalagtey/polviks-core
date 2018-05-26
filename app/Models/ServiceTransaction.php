<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceTransaction extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
	protected $table = 'service_transactions';

    protected $fillable = [
    	'quantity',
    	'customer_id',
    	'service_id',
    ];

    public function customer() {
    	return $this->belongsTo(Customer::class);
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
