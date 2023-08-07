<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);

        //return collection of products as a resource
        return new ProductResource(true, 'Products Data List', $products);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is not empty
        if ($request->hasFile('image')) {
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());
            $image = $image->hashName();
        } else {
            $image = null;
        }

        //create product
        $product = Product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
            'image' => $image,
            'name' => $request->name,
            'is_available' => $request->is_available,
        ]);

        return new ProductResource(true, 'Product Created', $product);
    }

    public function show(Product $product)
    {
        return new ProductResource(true, 'Product Data Found!', $product);
    }

    public function update(Request $request, Product $product)
    {
        //define validation rules
        // $validator = Validator::make($request->all(), [
        //     'category_id' => 'required',
        // ]);

        // check if validation fails
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            //delete old image
            Storage::delete('public/products/'.$product->image);

            //update product with new image
            $product->update([
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'size_id' => $request->size_id,
                'color_id' => $request->color_id,
                'image' => $image->hashName(),
                'name' => $request->name,
                'is_available' => $request->is_available,
            ]);

        } else {

            //update product without image
            $product->update([
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'size_id' => $request->size_id,
                'color_id' => $request->color_id,
                'name' => $request->name,
                'is_available' => $request->is_available,
            ]);
        }

        return new ProductResource(true, 'Product Updated', $product);
    }

    public function destroy(Product $product)
    {
        //delete image
        Storage::delete('public/products/'.$product->image);

        //delete product
        $product->delete();

        //return response
        return new ProductResource(true, 'Product Data Deleted!', null);
    }
}
