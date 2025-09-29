<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resedit_businessource.
     */
    public function index()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Category',
                'url' => route('adminCategory')
            ],
            [
                'label' => 'SubCategory',
                'url' => null
            ],
        ];
        return view('admin.subcategory.index',compact('breadcrumbs'));
    }

    public function fetchTableData(){
        $result = ['data' => []];

        $subcategories = SubCategory::with('category')->select('id', 'category_id','name', 'slug', 'status')->orderBy('id', 'desc')->get(); 
        
        foreach ($subcategories as $key => $category) {
            $buttons = ''; $status  =''; $icon= '';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="editFunc(' . $category->id . ')" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i></button>';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $category->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';

            if($category->status == 1) {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$category->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            }else{
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$category->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }

            $icon = '<i class="'.$category->icon.'" style="font-size:20px;"></i>';

            $result['data'][$key] = [
                $category->name,
                $category->slug,
                $category->category->name,
                $status,
                $buttons,
            ];
        }

        return response()->json($result);
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'category' => 'required|integer',
            'name' => 'required|string|min:3|max:255|unique:subcategories,name',
            'status' => 'required|in:0,1',
        ]);

        $category = $request->input('category');
        $name = $request->input('name');
        $slug = Str::slug($name);
        $status = $request->input('status');

        SubCategory::create([
            'category_id' => $category,
            'name' => $name,
            'slug' => $slug,
            'status' => $status,
        ]);

        return response()->json(['messages' => 'SubCategory added successfully', 'status' => true], 200);
    } catch (\Illuminate\Validation\ValidationException $validationException) {
        $errors = $validationException->errors();
        return response()->json(['error' => $errors, 'status' => false]);
    } catch (\Illuminate\Database\QueryException $queryException) {
        \Log::error('Database error occurred: ' . $queryException->getMessage());
        return response()->json(['error' => 'An error occurred while adding the record', 'status' => false], 500);
    }
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
    $subcategory = SubCategory::with('category')->find($id);

    // Check if the subcategory exists
    if (!$subcategory) {
        return response()->json(['message' => 'Subcategory not found', 'status' => false], 404);
    }
    
    $categoryName = $subcategory->category ? $subcategory->category->name : null;
    $categoryid = $subcategory->category ? $subcategory->category->id : null;

    return response()->json(['subcategory' => $subcategory, 'category_id' => $categoryid, 'category_name' => $categoryName, 'status' => true], 200);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    try {
        $rules = [
            'cat_id' => 'required|exists:subcategories,id',
            'edit_category' => 'required|integer',
            'edit_name' => 'required|string|min:3|max:255|unique:subcategories,name,' . $request->cat_id,
            'edit_status' => 'required|in:0,1',
        ];

        $messages = [
            'cat_id.exists' => 'Invalid subcategory id.',
            'edit_category.required' => 'The category field is required.',
            'edit_name.required' => 'The name field is required.',
            'edit_name.unique' => 'The name has already been taken.',
            'edit_status.in' => 'Invalid status value.',
        ];

        $request->validate($rules, $messages);

        $subcategory = SubCategory::find($request->input('cat_id'));
        if (!$subcategory) {
            return response()->json(['error' => 'Subcategory not found', 'success' => false]);
        }

        $slug = Str::slug($request->input('edit_name'));

        $subcategory->update([
            'category_id' => $request->input('edit_category'),
            'name' => $request->input('edit_name'),
            'slug' => $slug,
            'status' => $request->input('edit_status'),
        ]);

        return response()->json(['success' => true, 'message' => 'Subcategory updated successfully']);
    } catch (\Illuminate\Validation\ValidationException $validationException) {
        $errors = $validationException->errors();
        return response()->json(['errors' => $errors, 'success' => false]);
    } catch (\Illuminate\Database\QueryException $e) {
        // Check if it's a duplicate entry exception
        if ($e->getCode() == '23000') {
            return response()->json(['error' => 'The name has already been taken.', 'success' => false]);
        }
        \Log::error('Error occurred while updating record: ' . $e->getMessage());
        return response()->json(['error' => 'An error occurred while updating the record.', 'success' => false]);
    } catch (\Exception $e) {
        \Log::error('Error occurred while updating record: ' . $e->getMessage());
        return response()->json(['error' => 'An unexpected error occurred.', 'success' => false]);
    }
}



    /** 
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $subcategoryId = $request->input('del_id');
            $subcategory = SubCategory::find($subcategoryId);
    
            if (!$subcategory) {
                return response()->json(['success' => false, 'message' => 'Subcategory not found'], 404);
            }
    
            $subcategory->delete();
    
            return response()->json(['success' => true, 'message' => 'Subcategory deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting subcategory', 'error' => $e->getMessage()]);
        }
    }

    // change status
    function changeStatus(Request $request){

        $category = SubCategory::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();
        
        return response(['message' => 'status changed']);
    }

}
