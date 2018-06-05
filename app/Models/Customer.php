<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\Transaction;
use App\Scopes\CustomerScope;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Transformers\CustomerTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const PREMIUM_USER = 'true';
    const REGULAR_USER = 'false';

    // protected $guard = 'customer';
    public $transformer = CustomerTransformer::class;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'verified',
        'verification_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope(new CustomerScope);
    // }

    public function isVerified()
    {
        return $this->verified == Customer::VERIFIED_USER;
    }

    public function products()
    {
    	return $this->hasMany(ProductTransaction::class);
    }

    public function services()
    {
        return $this->hasMany(ServiceTransaction::class);
    }

    public function productsAndServices()
    {
        return $this->products()->union($this->services()->toBase());
    }

    public static function generateVerificationCode()
    {
        return str_random(40);
    }
}
