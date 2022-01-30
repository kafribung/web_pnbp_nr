<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DesaResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    // public $preserveKeys = true;

    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            // 'data' => $this->collection,
            'name' => $this->name,
        ];
    }
}
