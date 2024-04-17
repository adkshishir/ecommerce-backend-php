<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ParentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.view', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parent_categories = ParentCategory::pluck('name', 'id');
        return view('admin.category.create', ['parent_categories' => $parent_categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'parent_id' => 'required',
            'description' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            // 'status' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($validator->fails()) {
            return redirect()->route('category.create')->withErrors($validator->errors())->withInput();
        }
        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'slug' => $request->slug,
            'status' => 'active',
        ]);
        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')->toMediaCollection('category_image');
        }
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        return view('admin.category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        $parent_category = ParentCategory::pluck('name', 'id');
        $image = $category->getMedia('category_image')->first()->getUrl();
        $category['image'] = $image;
        return view('admin.category.edit', ['category' => $category, 'parent_category' => $parent_category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //    validate
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'required|string|max:255',
            // 'status' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($validator->fails()) {
            return redirect()->route('category.edit', $id)->withErrors($validator->errors())->withInput();
        }
        $category = Category::find($id);
        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'slug' => $request->slug,
        ]);
        if ($request->hasFile('image')) {
            $category->clearMediaCollection('category_image');
            $category->addMediaFromRequest('image')->toMediaCollection('category_image');
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index', ['category' => $category, 'status' => 'deleted']);
    }
}
