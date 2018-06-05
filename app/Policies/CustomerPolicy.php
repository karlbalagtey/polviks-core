<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function view(User $user, Customer $customer)
    {
        return $user->id === $customer->id;
    }

    /**
     * Determine whether the user can purchase something.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function purchase(User $user, Customer $customer)
    {
        return $user->id === $customer->id;
    }
}
