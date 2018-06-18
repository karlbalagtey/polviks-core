<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user instanceOf User) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the service policy.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function addCategory(Service $service)
    {
        return Auth::guard('agent-api')->user()->id === $service->agent->id;
    }

    /**
     * Determine whether the user can delete the service policy.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function deleteCategory(Service $service)
    {
        return Auth::guard('agent-api')->user()->id === $service->agent->id;
    }
}
