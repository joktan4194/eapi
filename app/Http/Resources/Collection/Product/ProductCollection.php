<?php

namespace App\Http\Resources\Collection\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        ['name'=>$this->name,
         'discount'=>$this->discount.'%',
         'total_price'=>round(( (1- ($this->discount/100) ) * $this->price),2),
         'href'=>
             ['link'=>route('products.show',$this->id)]
         ];
    }
}
