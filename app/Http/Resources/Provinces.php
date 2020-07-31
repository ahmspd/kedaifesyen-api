<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Provinces extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status' => 'success',
            'message' => 'provinces data',
            'data' => parent::toArray($request),
        ];
    }
}
