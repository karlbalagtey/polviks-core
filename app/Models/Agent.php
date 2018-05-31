<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Service;
use App\Scopes\AgentScope;
use Laravel\Passport\HasApiTokens;
use App\Transformers\AgentTransformer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agent extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    public $transformer = AgentTransformer::class;

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

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope(new AgentScope);
    // }

    public function isVerified()
    {
        return $this->verified == Agent::VERIFIED_USER;
    }

    public function isAdmin()
    {
        return $this->admin == Agent::ADMIN_USER;
    }

    public static function generateVerificationCode()
    {
        return str_random(40);
    }

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
