<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ParentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable;

class ParentCategoryController extends Controller
{
    //
    public function index()
    {
        $parent_categories = ParentCategory::select('id', 'name', 'description', 'slug')->latest()->get();

        return view('admin.parent-category.view', ['parent_categories' => $parent_categories]);
    }
    public function create()
    {

        return view('admin.parent-category.create');
    }
    public function store(Request $request)
    {

        $response = [];
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            if ($validator->fails()) {
                return redirect()->route('parent-category.create')->withErrors($validator->errors())->withInput();
            }
            $parent_activity = ParentCategory::create($request->all());
            if ($request->hasFile("image"))
                $parent_activity->addMediaFromRequest('image')->toMediaCollection('parent_category_image');
            $response['status'] = true;
            $response['message'] = "Parent Category Added Successfully";
            return \redirect()->route('parent-category.view', $response);
        } catch (\Exception $e) {
            $response['status'] = false;
            $response['message'] = $e->getMessage();
            $response['error'] = $e->getMessage();
            return \redirect()->route('parent-category.create', $response);
        }
    }
    public function edit(string $id)
    {
        $parent_category = ParentCategory::find($id);
        $image = $parent_category->getMedia('parent_category_image')->first()->getUrl();
        $parent_category['image'] = $image;
        return view('admin.parent-category.edit', ['parent_category' => $parent_category]);
    }
    public function update(string $id, Request $request)
    {

        try {
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'description' => 'required',
                    'slug' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]
            );
            $parent_category = ParentCategory::find($id);
            $parent_category->update([
                'name' => $request->name,
                'description' => $request->description,
                'slug' => $request->slug,
            ]);
            if ($request->hasFile("image")) {
                $parent_category->clearMediaCollection("parent_category_image");
                $parent_category->addMediaFromUrl($request->image)->toMediaCollection("parent_category_image");
            }
            return \redirect()->route('parent-category.view', ['message' => "Parent Category Updated Successfully"]);
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function destroy(string $id)
    {
        $response = [];
        $parent_category = ParentCategory::find($id);
        $parent_category->delete();
        $parent_category->clearMediaCollection("parent_category_image");
        $response['status'] = true;
        $response['message'] = "Parent Category Deleted Successfully";
        return \redirect()->route('parent-category.view', $response);
    }
}
