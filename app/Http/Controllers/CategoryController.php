<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Category=Category::get();
        return view("admin.allcategory",['data'=>$Category]);
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
    public function store(StoreCategoryRequest $request)
    {
        $input=$request->all();
        Category::create($input);
        return redirect("/category")->withSuccess("  Category   Added ");

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect("/category")->withSuccess("  Category   Deleted ");

    }
    public function categorybook($id)
    {
        $books=Book::where([["cat_id",$id],["statuse","published"]])->get()->sortDesc();
        return view("book.categorybook",["data"=>$books,'id'=>$id]);
    }
}
