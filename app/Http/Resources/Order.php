<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parent = parent::toArray($request);

        $data['fashion_order'] = $this->fashion_order;
        $data = array_merge($parent, $data);
        return [
            'status' => 'success',
            'message' => 'Order Data',
            'data' => $data
        ];
    }
}
