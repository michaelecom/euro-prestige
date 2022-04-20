<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function categories()
    {
        return response()->json(Category::all());
    }



    public function addCategory(Request $req)
    {
        if ($req->all() == [])
            return response()->json('', 400);

        $category = Category::create($req->all());

        return response()->json($category, 201);
    }

    public function editCategory(Category $category, Request $req)
    {
        if ($req->all() == [])
            return response()->json('', 400);

        $category->update($req->all());

        return response()->json($category, 200);
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();

        return response()->json('', 204);
    }



    public function addCategoryProperty(Category $category, Request $req)
    {
        if ($req->all() == [])
            return response()->json('', 400);

        $category = Category::find($category)->first();

        $property = $category->property;

        if ($property == null)
            $property = array();

        array_push($property, $req->property);

        $category->update(array('property' => $property));

        return response()->json($category, 201);
    }

    public function editCategoryProperty(Category $category, Request $req)
    {
        if ($req->all() == [])
            return response()->json('', 400);

        $category = Category::find($category)->first();

        $property = explode(',', str_replace(' ', '', $req->property));

        $category->update(array('property' => $property));

        return response()->json($category, 200);
    }

    public function deleteCategoryProperty(Category $category)
    {
        $category = Category::find($category)->first();

        $category->update(array('property' => null));

        return response()->json('', 204);
    }
}
