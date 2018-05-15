<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Branch extends JsonResource
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
            'id' => $this->id,
            'address' => [
                'branch_address' => $this->address,
                'city' => $this->city->name,
                'country' => $this->city->country->name,
            ],
            'is_active' => $this->is_active,
        ];
    }
}
