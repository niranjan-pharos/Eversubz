<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NgoCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NgoCategoryController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'NGO Category List',
                'url' => null
            ],
        ];
        return view('admin.ngo_categories.index',compact('breadcrumbs'));
    }

    public function fetchTableData()
    {
        $result = ['data' => []]; 

        $categories = NgoCategory::orderBy('id', 'desc')->get();

        foreach ($categories as $key => $category) {
            $buttons = '';
            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="editNgoCatFunc(' . $category->id . ')"  data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i></button>';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $category->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';

            $status = $category->status ? 
                '<div class="form-check form-switch"><input class="form-check-input change-status" data-id="'.$category->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>' :
                '<div class="form-check form-switch"><input class="form-check-input change-status" data-id="'.$category->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked"></div>';

            $imagePath = $category->image ? asset('storage/' . $category->image) : asset('storage/no-image.jpg');

            $categorySlugHtml = '<span class="business-badge business-everstore">
                                    <span class="business-dot"></span>' . htmlspecialchars($category->slug ?? '-') . '
                                 </span>';

            $result['data'][$key] = [
                '<img src="' . $imagePath . '" alt="Category Image" class="img-thumbnail" style="width: 50px; height: 50px;">',
                $category->name,
                $categorySlugHtml,
                $status,
                optional($category->created_at)->format('d-m-Y'),
                optional($category->updated_at)->format('d-m-Y'),
                $buttons,
            ];
        }

        return response()->json($result);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:ngo_categories,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $slug = Str::slug($request->name);

        if (NgoCategory::where('slug', $slug)->exists()) {
            return response()->json(['errors' => ['slug' => ['Slug already exists.']]], 422);
        }

        $imagePath = $request->file('image') ? $request->file('image')->store('ngo_categories', 'public') : null;

        NgoCategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return response()->json(['status' => true, 'messages' => 'Category created successfully.']);
    }

    public function editNgoCategory(Request $request)
    {
        $cat_id = $request->id;
        $ngoCatInfo = NgoCategory::findOrFail($cat_id);

        return response()->json(['success' => $ngoCatInfo, 'status' => true], 200);
    }

    public function update(Request $request)
{
    $id = $request->cat_id;
    $category = NgoCategory::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:ngo_categories,name,' . $category->id,
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'required|in:0,1',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $slug = Str::slug($request->name);

    if (NgoCategory::where('slug', $slug)->where('id', '!=', $id)->exists()) {
        return response()->json(['errors' => ['slug' => ['Slug already exists.']]], 422);
    }

    // Update category name, slug, and status
    $category->name = $request->name;
    $category->slug = $slug;
    $category->status = $request->status;

    // Handle image update
    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        // Store new image
        $imagePath = $request->file('image')->store('ngo_categories', 'public');
        $category->image = $imagePath;
    }

    $category->save();

    return response()->json(['success' => true, 'message' => 'Category updated successfully.']);
}

    public function changeNgoCategoryStatus(Request $request)
    {
        $category = NgoCategory::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();
        
        return response(['message' => 'status changed']);
    }

    public function destroy(Request $request)
    { 
        $category = NgoCategory::findOrFail($request->del_id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();

        return response()->json(['success' => true, 'messages' => 'Category deleted successfully.']);
    }

}
