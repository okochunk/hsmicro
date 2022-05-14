<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Products::getAllProduct($request)->paginate(config('pagination.admin.per_page'));

        return view('admin/products/index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Products();

        $categories = Categories::getAllCategory([])->get()->pluck('name', 'id');

        return view('admin/products/create', compact('product', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'internal_code' => 'required|unique:products,internal_code',
            'category_id'   => 'required|numeric',
            'quantity'      => 'required|numeric',
            'price'         => 'required|between:0,99.99',
            'is_active'     => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Products::storeProduct($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $notification = [
            'message' => 'Products created successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($products)
    {
        $product = Products::find($products);

        $categories = Categories::getAllCategory([])->get()->pluck('name', 'id');

        return view('admin/products/edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'internal_code' => 'required|unique:products,internal_code,'.$id,
            'category_id'   => 'required|numeric',
            'quantity'      => 'required|numeric',
            'price'         => 'required|between:0,99.99',
            'is_active'     => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.edit', [$id])
                ->withErrors($validator)
                ->withInput();
        }

        $product                = Products::find($id);
        $product->name          = $request->get('name');
        $product->internal_code = $request->get('internal_code');
        $product->category_id   = $request->get('category_id');
        $product->quantity      = $request->get('quantity');
        $product->price         = $request->get('price');
        $product->is_active     = $request->get('is_active');

        $product->save();

        $notification = [
            'message'    => 'Category updated successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();

        $notification = [
            'message' => 'Product deleted successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('products.index')->with($notification);
    }
}
