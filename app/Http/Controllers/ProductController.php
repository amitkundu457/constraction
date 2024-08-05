<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use App\Models\FoodUnit;
use App\Models\Product;
use App\Models\Vender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $units = FoodUnit::all();
        $categories = FoodCategory::all();
        $venders = Vender::all();
        return \view('food.index',\compact('products','units','categories','venders'));
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
    public function store(Request $request)
    {
        $product = new Product();
        
        if($request->file('file')){
            $product->image = $request->file('file')->store('uploads/food','public');            
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->vender_id = $request->vender_id;
        $product->food_unit_id = $request->food_unit_id;
        $product->food_category_id = $request->food_category_id;
        $product->description = $request->description;
        $product->save();
        return \redirect()->back()->with('status','Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $product = Product::findOrFail($id);
        
        if($request->file('file')){
            if($product->image && Storage::exists($product->image)){
                Storage::delete($product->image);
            }
            $product->image = $request->file('file')->store('uploads/food','public');            
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->vender_id = $request->vender_id;
        $product->food_unit_id = $request->food_unit_id;
        $product->food_category_id = $request->food_category_id;
        $product->description = $request->description;
        $product->save();
        return \redirect()->back()->with('status','Product updated successfully');
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
        if(Storage::exists($product->image)){
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return \redirect()->back()->with('status','Product deleted successfully');
    }
}
