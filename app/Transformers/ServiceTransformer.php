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
            'available' =>(int)$service->quantity,
            'status' => (string)$service->status,
            'agent' => (int)$service->agent_id,
            'createdDate' => (string)$service->created_at,
            'updatedDate' => (string)$service->updated_at,
            'deletedDate' => isset($service->deleted_at) ? (string) $service->deleted_at : null,
        ];
    }
}
