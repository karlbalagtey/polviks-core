<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user instanceOf User) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function view(Customer $customer)
    {
        return (int)Route::current()->parameters('customer')['customer'] === $customer->id;
    }

    /**
     * Determine whether the user can purchase.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function purchase(Customer $customer)
    {
        return (int)Route::current()->parameters('customer')['customer'] === $customer->id;
    }
}
