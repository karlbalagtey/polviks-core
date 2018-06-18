<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product transaction.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductTransaction  $productTransaction
     * @return mixed
     */
    public function view(ProductTransaction $productTransaction)
    {
        return Auth::guard('customer-api')->user()->id === $productTransaction->customer->id || Auth::guard('agent-api')->user()->id === $productTransaction->service->agent->id;
    }
}
