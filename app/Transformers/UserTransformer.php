<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identifier' => (int)$user->id,
            'firstName' => (string)$user->first_name,
            'lastName' => (string)$user->last_name,
            'username' => (string)$user->username,
            'email' => (string)$user->email,
            'isVerified' => (int)$user->verified,
            'isAdmin' => ($user->admin === 'true'),
            'createdDate' => (string)$user->created_at,
            'updatedDate' => (string)$user->updated_at,
            'deletedDate' => isset($user->deleted_at) ? (string) $user->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('users.show', $user->id),
                ],
            ]
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
     * Transformed attributes.
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
