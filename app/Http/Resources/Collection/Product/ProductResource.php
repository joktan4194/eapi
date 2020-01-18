<?php

namespace App\Http\Resources\Collection\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return 
        ['name'=>$this->name,
        'description'=>$this->detail,
        'discount'=>$this->discount,
        'price'=>$this->price,
        'stock'=>$this->stock];
    }
}
