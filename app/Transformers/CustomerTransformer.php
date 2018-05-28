<?php

namespace App\Transformers;

use App\Models\Customer;
use League\Fractal\TransformerAbstract;

class CustomerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Customer $customer)
    {
        return [
            'identifier' => (int)$customer->id,
            'firstName' => (string)$customer->first_name,
            'lastName' => (string)$customer->last_name,
            'username' =>(string)$customer->username,
            'email' => (string)$customer->email,
            'isVerified' => (int)$customer->verified,
            'createdDate' => (string)$customer->created_at,
            'updatedDate' => (string)$customer->updated_at,
            'deletedDate' => isset($customer->deleted_at) ? (string) $customer->deleted_at : null,
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
            'createdDate' => 'created_at',
            'updatedDate' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
