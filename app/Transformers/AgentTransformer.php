<?php

namespace App\Transformers;

use App\Models\Agent;
use League\Fractal\TransformerAbstract;

class AgentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Agent $agent)
    {
        return [
            'identifier' => (int)$agent->id,
            'firstName' => (string)$agent->first_name,
            'lastName' => (string)$agent->last_name,
            'username' =>(string)$agent->username,
            'email' => (string)$agent->email,
            'isVerified' => (int)$agent->verified,
            'isAdmin' => ($agent->admin === 'true'),
            'createdDate' => (string)$agent->created_at,
            'updatedDate' => (string)$agent->updated_at,
            'deletedDate' => isset($agent->deleted_at) ? (string) $agent->deleted_at : null,
            
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('agents.show', $agent->id),
                ],
                [
                    'rel' => 'agent.customers',
                    'href' => route('agents.customers.index', [$agent->id, 'services']),
                ],
                [
                    'rel' => 'agent.customers',
                    'href' => route('agents.customers.index', [$agent->id, 'products']),
                ],
                [
                    'rel' => 'agent.categories',
                    'href' => route('agents.categories.index', [$agent->id, 'services']),
                ],
                [
                    'rel' => 'agent.categories',
                    'href' => route('agents.categories.index', [$agent->id, 'products']),
                ],
                [
                    'rel' => 'agent.products',
                    'href' => route('agents.products.index', $agent->id),
                ],
                [
                    'rel' => 'agent.services',
                    'href' => route('agents.services.index', $agent->id),
                ],
                [
                    'rel' => 'agent.transactions',
                    'href' => route('agents.transactions.index', [$agent->id, 'services']),
                ],
                [
                    'rel' => 'agent.transactions',
                    'href' => route('agents.transactions.index', [$agent->id, 'products']),
                ],
            ],
        ];
    }

    /**
     * Original attributes.
     *
     * @return array
     */
    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'firstName' => 'first_name',
            'lastName' => 'last_name',
            'username' =>'username',
            'email' => 'email',
            'isVerified' => 'verified',
            'isAdmin' => 'admin',
            'createdDate' => 'created_at',
            'updatedDate' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    /**
     * Original attributes.
     *
     * @return array
     */
    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identifier',
            'first_name' => 'firstName',
            'last_name' => 'lastName',
            'username' => 'username',
            'email' => 'email',
            'verified' => 'isVerified',
            'admin' => 'isAdmin',
            'created_at' => 'createdDate',
            'updated_at' => 'updatedDate',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
