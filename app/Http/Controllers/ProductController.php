<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // ---------------- index------------
    // this method will show products page
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.list', [
            'products' => $products
        ]);
    }

    // -------------- create ------------------
    // this method will create products
    public function create()
    {
        return view("products.create");
    }

    // ----------- store --------------
    // this method will store products in db
    public function store(Request $request)
    {
        // return $request;
        $rules = [
            "name" => "required|string|min:5",
            "sku" => "required|min:3",
            "price" => "required|numeric"
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route("products.create")->withInput()->withErrors($validator);
        }

        // now store in db
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            // store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;

            // save image in public/uploads/products folder
            $image->move(public_path('uploads/products'), $imageName);

            // save image name in db
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product added Successfully');
    }

    // ---------- edit -----------
    // this method will edit products
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product'=> $product
        ]);
    }

    // -------- update -------------
    // this method will update products
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $rules = [
            "name" => "required|string|min:5",
            "sku" => "required|min:3",
            "price" => "required|numeric"
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route("products.edit", $product->id)->withInput()->withErrors($validator);
        }

        // now update & store in db
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            // delete old image
            File::delete(public_path('uploads/products/'.$product->image));

            // store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;

            // save image in public/uploads/products folder
            $image->move(public_path('uploads/products'), $imageName);

            // save image name in db
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    // ------------ delete --------------
    // this method will delete products
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // delete image
        File::delete(public_path('uploads/products/'.$product->image));

        // delete product from db
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');

    }
}