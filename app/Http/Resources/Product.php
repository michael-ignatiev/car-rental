<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'model' => $this->model,
            'price_per_hour' => $this->price_per_hour,
            'branch_address' => [
                'address' => $this->branch->address,
                'city' => $this->branch->city->name,
                'country' => $this->branch->city->country->name,
            ],
        ];
    }
}
