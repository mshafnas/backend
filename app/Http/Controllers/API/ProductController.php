<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $products = Product::latest()->paginate(9);

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:191',
            'qty' => 'required',
            'price' => 'required',
        ]);

        $product = new Product;
        $product->title = $request->title;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->photo = 'product.png';
        $product->save();

        return response()->json(['message' => 'success']);
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

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get product 
        $product = Product::find($id);

        // validate
        $this->validate($request, [
            'title' => 'required|string|max:191',
            'qty' => 'required',
            'price' => 'required',
        ]);
        
        // update user info
        $product->update($request->all());
        //return response
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get product 
        $product = Product::find($id);

        $product->delete();

        return response()->json(['message' => 'deleted']);
    }
}
