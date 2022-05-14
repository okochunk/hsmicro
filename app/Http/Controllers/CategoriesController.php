<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Categories::getAllCategory($request)->paginate(config('pagination.admin.per_page'));

        return view('admin/categories/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Categories();
        return view('admin/categories/create', compact('category'));
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
            'name'      => 'required',
            'is_active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->route('categories.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Categories::storeCategory($request->name, $request->is_active);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $notification = [
            'message' => 'Category created successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('categories.index')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($categories)
    {
        $category = Categories::find($categories);

        return view('admin/categories/edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'is_active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->route('categories.edit', [$id])
                ->withErrors($validator)
                ->withInput();
        }

        $category = Categories::find($id);
        $category->name = $request->get('name');
        $category->is_active = $request->get('is_active');
        $category->save();

        $notification = [
            'message' => 'Category updated successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('categories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();

        $notification = [
            'message' => 'Category deleted successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('categories.index')->with($notification);
    }
}
