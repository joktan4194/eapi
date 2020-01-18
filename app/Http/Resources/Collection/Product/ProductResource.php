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
        'discount'=>$this->discount.'%',
        'price'=>$this->price,
        'total_price'=>round(( (1- ($this->discount/100) ) * $this->price),2),
        'stock'=>$this->stock==0?'Out of Stock':$this->stock,
        'rating'=>$this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2):'This Product has not been rated yet',
        'href'=>
            ['reviews'=>route('reviews.index',$this->id)]
        ];
    }
}
