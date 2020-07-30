<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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

        $data['fashions'] = $this->fashions()->paginate(6);
        $data = array_merge($parent, $data);
        return [
            'status' => 'success',
            'message' => 'Category Data',
            'data' => $data
        ];
    }
}
