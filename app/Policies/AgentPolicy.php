<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agent;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgentPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user instanceOf User) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the agent.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Agent  $agent
     * @return mixed
     */
    public function view(Agent $agent)
    {
        return (int)Route::current()->parameters('agent')['agent'] === $agent->id;
    }

    /**
     * Determine whether the user can sell products or services.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function sell(Agent $agent)
    {
        return (int)Route::current()->parameters('agent')['agent'] === $agent->id;
    }

    /**
     * Determine whether the user can update a product or service.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Agent  $agent
     * @return mixed
     */
    public function editProduct(Agent $agent)
    {
        return (int)Route::current()->parameters('agent')['agent'] === $agent->id;
    }

    /**
     * Determine whether the user can delete a product or service.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Agent  $agent
     * @return mixed
     */
    public function deleteProduct(Agent $agent)
    {
        return (int)Route::current()->parameters('agent')['agent'] === $agent->id;
    }

    /**
     * Determine whether the user can update a product or service.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Agent  $agent
     * @return mixed
     */
    public function editService(Agent $agent)
    {
        return (int)Route::current()->parameters('agent')['agent'] === $agent->id;
    }

    /**
     * Determine whether the user can delete a product or service.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Agent  $agent
     * @return mixed
     */
    public function deleteService(Agent $agent)
    {
        return (int)Route::current()->parameters('agent')['agent'] === $agent->id;
    }
}
