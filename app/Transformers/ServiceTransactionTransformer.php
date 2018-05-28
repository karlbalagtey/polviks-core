<?php

namespace App\Transformers;

use App\Models\ServiceTransaction;
use League\Fractal\TransformerAbstract;

class ServiceTransactionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ServiceTransaction $transaction)
    {
        return [
            'identifier' => (int)$transaction->id,
            'quantity' => (int)$transaction->quantity,
            'buyer' => (int)$transaction->customer_id,
            'service' => (int)$transaction->service_id,
            'createdDate' => (string)$transaction->created_at,
            'updatedDate' => (string)$transaction->updated_at,
            'deletedDate' => isset($transaction->deleted_at) ? (string) $transaction->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('services-transactions.show', $transaction->id),
                ],
                [
                    'rel' => 'transaction.categories',
                    'href' => route('services-transactions.categories.index', $transaction->id),
                ],
                [
                    'rel' => 'transaction.agents',
                    'href' => route('services-transactions.agents.index', $transaction->id),
                ],
                [
                    'rel' => 'customer',
                    'href' => route('customers.show', $transaction->customer_id),
                ],
                [
                    'rel' => 'product',
                    'href' => route('products.show', $transaction->service_id),
                ]
            ]
        ];
    }

    /**
     * Original attributes.
     *
     * @return array
     */
    public static function originalAttributes($index)
    {
        $attributes = [
            'identifier' => 'id',
            'quantity' => 'quantity',
            'buyer' => 'customer_id',
            'service' => 'service_id',
            'createdDate' => 'created_at',
            'updatedDate' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
