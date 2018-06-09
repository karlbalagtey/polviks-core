<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ServiceTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceTransactionPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user instanceOf User) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the service transaction.
     *
     * @param  \App\Models\ServiceTransaction  $serviceTransaction
     * @return mixed
     */
    public function view(ServiceTransaction $serviceTransaction)
    {
        return Auth::guard('customer-api')->user()->id === $serviceTransaction->customer->id || Auth::guard('agent-api')->user()->id === $serviceTransaction->service->agent->id;
    }
}
