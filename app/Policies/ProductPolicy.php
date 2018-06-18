<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user instanceOf User) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the product policy.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductPolicy  $productPolicy
     * @return mixed
     */
    public function addCategory(Product $product)
    {
        return Auth::guard('agent-api')->user()->id === $product->agent->id;
    }

    /**
     * Determine whether the user can delete the product policy.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductPolicy  $productPolicy
     * @return mixed
     */
    public function deleteCategory(Product $product)
    {
        return Auth::guard('agent-api')->user()->id === $product->agent->id;
    }
}
