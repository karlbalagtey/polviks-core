<?php

namespace App\Policies;

use App\Models\User;
use App\Agent;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the agent.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Agent  $agent
     * @return mixed
     */
    public function view(User $user, Agent $agent)
    {
        //
    }

    /**
     * Determine whether the user can create agents.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the agent.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Agent  $agent
     * @return mixed
     */
    public function update(User $user, Agent $agent)
    {
        //
    }

    /**
     * Determine whether the user can delete the agent.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Agent  $agent
     * @return mixed
     */
    public function delete(User $user, Agent $agent)
    {
        //
    }
}
