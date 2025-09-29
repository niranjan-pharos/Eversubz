<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\BusinessCategory;
use Str;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
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
                'url' => null
            ],
        ];
        return view('admin.category.index',compact('breadcrumbs'));
    }

    public function fetchTableData(){
        $result = ['data' => []];

        $categories = Category::select('id', 'icon','name', 'slug','status')->get();

        foreach ($categories as $key => $category) {
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

            $icon = '<img class="img img-thumbnail" src="' . asset('storage/' . $category->icon) . '" style="width:60px; height:60px;">';

            $result['data'][$key] = [
                $icon,
                $category->name,
                $category->slug,
                $status,
                $buttons,
            ];
        }

        return response()->json($result);
    }


    // Business Category
    public function businessCategoryIndex()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Business Category',
                'url' => null
            ],
        ];
        
        return view('admin.businesscategory.index',compact('breadcrumbs'));
    }

    public function fetchbusinessCategoryData(){

        $result = ['data' => []];

        $categories = BusinessCategory::select('id', 'icon','name', 'slug','status')->orderBy('id', 'desc')->get();

        foreach ($categories as $key => $category) {
            $buttons = ''; $status  =''; $icon= '';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="editBusCatFunc(' . $category->id . ')"  data-bs-toggle="modal" data-bs-target="#editBusinessForm"><i class="fa fa-pencil"></i></button>';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $category->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';

            if($category->status == 1) {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$category->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            }else{
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$category->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }

            $icon = '<img class="img img-thumbnail" src="' . asset('storage/' . $category->icon) . '" style="width:60px; height:60px;">';

            $result['data'][$key] = [
                $icon,
                $category->name,
                $category->slug,
                $status,
                $buttons,
            ];
        }

        return response()->json($result);
    }

    public function businessCategoryStore(Request $request)
    {
        try {
            $request->validate([
                'icon' => 'required|image|mimes:jpeg,png,jpg|max:1024', 
                'name' => 'required|string|min:3|max:255|unique:business_categories',
                'status' => 'required|in:0,1',
            ]);

            $name = $request->input('name');
            $slug = Str::slug($name);
            $status = $request->input('status');

            if ($request->hasFile('icon')) {
                $filename = time() . '.' . $request->file('icon')->getClientOriginalExtension();
                $imagePath = $request->file('icon')->storeAs('category_images', $filename, 'public');
            }
            
            BusinessCategory::create([
                'icon' => $imagePath ?? null, 
                'name' => $name,
                'slug' => $slug,
                'status' => $status,
            ]);

            return response()->json(['messages' => 'Business Category added successfully', 'status' => true], 200);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            $errors = $validationException->errors();
            return response()->json(['error' => $errors, 'status' => false]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while adding the record', 'status' => false], 500);
        }
    }

    public function businessCategoryEdit(string $id)
    {
        $category = BusinessCategory::find($id);

        return response()->json(['category' => $category, 'status' => true], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function businessCategoryUpdate(Request $request)
    {
        try {
            $rules = [
                'cat_id' => 'required|exists:business_categories,id',
                'edit_name' => 'required|string|min:3|max:255',
                'edit_icon' => 'image|mimes:jpeg,png,jpg|max:1024',
                'edit_status' => 'required|in:0,1',
            ];

            $messages = [
                'cat_id.exists' => 'Invalid category_id.',
                'edit_name.required' => 'The name field is required.',
                'edit_status.in' => 'Invalid status value.',
            ];

            $category = BusinessCategory::find($request->input('cat_id'));
            
            if (!$category) {
                return response()->json(['error' => 'Business Category not found']);
            }

            $imagePath = $category->icon;

            if ($request->hasFile('edit_icon')) {
                // Delete old icon if it exists
                if ($category->icon) {
                    Storage::disk('public')->delete($category->icon);
                }
        
                // Upload new icon
                $filename = time() . '.' . $request->file('edit_icon')->getClientOriginalExtension();
                $imagePath = $request->file('edit_icon')->storeAs('category_images', $filename, 'public');
            }

            $request->validate($rules, $messages);

            // Update category details
            $slug = Str::slug($request->input('edit_name'));
            $category->update([
                'icon' => $imagePath,
                'name' => $request->input('edit_name'),
                'slug' => $slug,
                'status' => $request->input('edit_status'),
            ]);

            return response()->json(['success' => true, 'messages' => 'Business Category updated successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            $errors = $validationException->errors();
            return response()->json(['error' => $errors, 'success' => false]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the record', 'success' => false]);
        }
    }

    public function businessCategorydestroy(Request $request)
    {
        try {
            $categoryId = $request->input('del_id');
            $category = BusinessCategory::find($categoryId);
    
            if (!$category) {
                return response()->json(['error' => false, 'messages' => 'Category not found']);
            }
    
            $category->delete();
    
            return response()->json(['success' => true, 'messages' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'messages' => 'Error deleting category']);
        }
    }

    // change status
    public function changeStatusBusinessCategory(Request $request){

        $category = BusinessCategory::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();
        
        return response(['message' => 'status changed']);
    }

    public function searchBusinessCategory(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $categories = BusinessCategory::where('name', 'like', '%' . $searchTerm . '%')->get();

        $result = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'text' => $category->name,
            ];
        });

        return response()->json($result);
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
        try {
            $request->validate([
                'icon' => 'required|image|mimes:jpeg,png,jpg|max:1024', // Image validation
                'name' => 'required|string|min:3|max:255|unique:categories',
                'status' => 'required|in:0,1',
            ]);

            $name = $request->input('name');
            $slug = Str::slug($name);
            $status = $request->input('status');

            if ($request->hasFile('icon')) {
                $filename = time() . '.' . $request->file('icon')->getClientOriginalExtension();
                $imagePath = $request->file('icon')->storeAs('category_images', $filename, 'public');
            }
            
            Category::create([
                'icon' => $imagePath ?? null, // Store path, or null if no image
                'name' => $name,
                'slug' => $slug,
                'status' => $status,
            ]);

            return response()->json(['messages' => 'Category added successfully', 'status' => true], 200);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            $errors = $validationException->errors();
            return response()->json(['error' => $errors, 'status' => false]);
        } catch (\Exception $e) {
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
        $category = category::find($id);

        return response()->json(['category' => $category, 'status' => true], 200);
    }

    public function update(Request $request)
    {
        try {
            $rules = [
                'cat_id' => 'required|exists:categories,id',
                'edit_name' => 'required|string|min:3|max:255',
                'edit_icon' => 'image|mimes:jpeg,png,jpg|max:1024',
                'edit_status' => 'required|in:0,1',
            ];

            $messages = [
                'cat_id.exists' => 'Invalid category_id.',
                'edit_name.required' => 'The name field is required.',
                'edit_status.in' => 'Invalid status value.',
            ];

            $category = Category::find($request->input('cat_id'));
            
            if (!$category) {
                return response()->json(['error' => 'Category not found']);
            }

            $imagePath = $category->icon;

            if ($request->hasFile('edit_icon')) {
                // Delete old icon if it exists
                if ($category->icon) {
                    Storage::disk('public')->delete($category->icon);
                }
        
                // Upload new icon
                $filename = time() . '.' . $request->file('edit_icon')->getClientOriginalExtension();
                $imagePath = $request->file('edit_icon')->storeAs('category_images', $filename, 'public');
            }

            $request->validate($rules, $messages);

            // Update category details
            $slug = Str::slug($request->input('edit_name'));
            $category->update([
                'icon' => $imagePath,
                'name' => $request->input('edit_name'),
                'slug' => $slug,
                'status' => $request->input('edit_status'),
            ]);

            return response()->json(['success' => true, 'messages' => 'Category updated successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            $errors = $validationException->errors();
            return response()->json(['error' => $errors, 'success' => false]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the record', 'success' => false]);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $categoryId = $request->input('del_id');
            $category = Category::find($categoryId);
    
            if (!$category) {
                return response()->json(['error' => false, 'messages' => 'Category not found']);
            }
    
            $category->delete();
    
            return response()->json(['success' => true, 'messages' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'messages' => 'Error deleting category']);
        }
    }

    // change status
    public function changeStatus(Request $request){

        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();
        
        return response(['message' => 'status changed successfully.']);
    }
    
    public function changeBusinessCategoryStatus(Request $request){

        $category = BusinessCategory::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();
        
        return response(['message' => 'status changed successfully.']);
    }

    public function searchCategory(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $categories = Category::where('name', 'like', '%' . $searchTerm . '%')->get();

        $result = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'text' => $category->name,
            ];
        });

        return response()->json($result);
    }

    public function ajaxSearchSubcategory(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $catId = $request->input('cat_id');

        $data = Subcategory::select('id', 'name as text')  
                        ->where('name', 'LIKE', '%' . $searchTerm . '%')
                        ->where('category_id', $catId)
                        ->get();

        return response()->json($data);
    }


}
