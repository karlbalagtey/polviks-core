<?php

namespace App\Transformers;

use App\Models\Service;
use League\Fractal\TransformerAbstract;

class ServiceTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Service $service)
    {
        return [
            'identifier' => (int)$service->id,
            'title' => (string)$service->name,
            'details' => (string)$service->description,
            'stock' =>(int)$service->quantity,
            'status' => (string)$service->status,
            'agent' => (int)$service->agent_id,
            'createdDate' => (string)$service->created_at,
            'updatedDate' => (string)$service->updated_at,
            'deletedDate' => isset($service->deleted_at) ? (string) $service->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('services.show', $service->id),
                ],
                [
                    'rel' => 'service.customers',
                    'href' => route('services.customers.index', $service->id),
                ],
                [
                    'rel' => 'service.categories',
                    'href' => route('services.categories.index', $service->id),
                ],
                [
                    'rel' => 'service.transactions',
                    'href' => route('services.transactions.index', $service->id),
                ],
                [
                    'rel' => 'agent',
                    'href' => route('agents.show', $service->agent_id),
                ]
            ]
        ];
    }

    /**
     * Original Attributes
     *
     * @return array
     */
    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'title' => 'name',
            'details' => 'description',
            'stock' => 'quantity',
            'status' => 'status',
            'agent' => 'agent_id',
            'createdDate' => 'created_at',
            'updatedDate' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    /**
     * Original Attributes
     *
     * @return array
     */
    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identifier',
            'name' => 'title',
            'description' => 'details',
            'quantity' => 'stock',
            'status' => 'status',
            'agent_id' => 'agent',
            'created_at' => 'createdDate',
            'updated_at' => 'updatedDate',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
