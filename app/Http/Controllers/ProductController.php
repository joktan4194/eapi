<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Http\Resources\Collection\Product\ProductCollection;
use App\Http\Resources\Collection\Product\ProductResource;
use App\Http\Requests\ProductRequest;
use Symfony\Component\HttpFoundation\Response; 
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }
    public function index()
    {
        return ProductCollection::collection(Product::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product= new Product;
        $product->name=$request->name;
        $product->price=$request->price;
        $product->discount=$request->discount;
        $product->stock=$request->stock;
        $product->detail=$request->description;
        $product->save();

        return response(["data"=> new ProductResource($product)],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
         $product->detail=$request->description;
         unset($request->description);
         $product->update($request->all());
         return response('Product Successfully Updated',Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //return$product;
        $product->delete();
        return response('Producted Successfully Deleted',Response::HTTP_NO_CONTENT);
    }
}
