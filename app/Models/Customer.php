<?php

namespace App\Models;

use App\Models\Transaction;
use App\Scopes\CustomerScope;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

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
        'admin'
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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CustomerScope);
    }

    public function isVerified()
    {
        return $this->verified == Agent::VERIFIED_USER;
    }

    public function transactions()
    {
    	return $this->hasMany(Transaction::class);
    }

    public static function generateVerificationCode()
    {
        return str_random(40);
    }
}
