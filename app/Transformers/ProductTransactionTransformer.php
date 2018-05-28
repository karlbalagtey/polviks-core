<?php

namespace App\Transformers;

use App\Models\ProductTransaction;
use League\Fractal\TransformerAbstract;

class ProductTransactionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ProductTransaction $transaction)
    {
        return [
            'identifier' => (int)$transaction->id,
            'quantity' => (int)$transaction->quantity,
            'buyer' => (int)$transaction->customer_id,
            'product' => (int)$transaction->product_id,
            'createdDate' => (string)$transaction->created_at,
            'updatedDate' => (string)$transaction->updated_at,
            'deletedDate' => isset($transaction->deleted_at) ? (string) $transaction->deleted_at : null,
        ];
    }
}
