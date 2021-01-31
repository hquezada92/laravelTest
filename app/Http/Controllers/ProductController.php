<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(15);
        return Response($products,200);
    }

    public function searchProduct($value)
    {
        $products = Product::paginate(15);
        if(empty(!$value)){
            $products = Product::where('sku','like',"%$value%")
                            ->orWhere('name','like',"%$value%")
                            ->paginate(15);
        }
        return response()->json($products,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $validated = $request->validated();
        return Product::create($request->only(
            [
                'sku',
                'name',
                'quantity',
                'imageUrl',
                'price',
                'description',
            ]
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $validated = $request->validated();
        $product = Product::find($id);
        $product->update($request->only(
            [
                'name',
                'quantity',
                'description',
                'imageUrl',
                'price'
            ]
        ));
        return response()->json($product,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['Deleted'=>'Successfully deleted'],200);
    }
}
