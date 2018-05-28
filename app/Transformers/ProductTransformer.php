<?php

namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'identifier' => (int)$product->id,
            'title' => (string)$product->name,
            'details' => (string)$product->description,
            'stock' =>(int)$product->quantity,
            'status' => (string)$product->status,
            'seller' => (int)$product->agent_id,
            'createdDate' => (string)$product->created_at,
            'updatedDate' => (string)$product->updated_at,
            'deletedDate' => isset($product->deleted_at) ? (string) $product->deleted_at : null,
        ];
    }
}
