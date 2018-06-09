<?php

namespace App\Policies;

use App\Models\ProductTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductTransactionPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user instanceOf User) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the product transaction.
     *
     * @param  \App\Models\ProductTransaction  $productTransaction
     * @return mixed
     */
    public function view(ProductTransaction $productTransaction)
    {
        return Auth::guard('customer-api')->user()->id === $productTransaction->customer->id || Auth::guard('agent-api')->user()->id === $productTransaction->product->agent->id;
    }
}
