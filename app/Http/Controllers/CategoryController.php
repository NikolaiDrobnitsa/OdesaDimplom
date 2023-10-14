<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('products','products.images')->get();
        return response()->json([
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->order = $request->order;
        $category->save();

        if ($request->image){
            $image = $request->image;
            $image_new_name = time().$image->getClientOriginalName();
            $image->move('categories/',$image_new_name);
            $category->image = $image_new_name;
            $category->save();
        }

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->order = $request->order;


        if ($request->image && $request->image !== $category->image){
                $image = $request->image;
                $image_new_name = time().$image->getClientOriginalName();
                $image->move('categories/',$image_new_name);
                $category->image = $image_new_name;

        }
        $category->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Категорія успішно видаленна!'
        ]);
    }
}
