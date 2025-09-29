<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobCategory;

use App\Models\JobExperience;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class JobsCategoryController extends Controller
{
    public function index()
    {
        // 
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Job Category',
                'url' => null
            ],
        ];
        return view('admin.jobscategory.index',compact('breadcrumbs'));
    }


    public function fetchJobsCategoryData()
    {
        $result = ['data' => []];
    
        $categories = JobCategory::select('id', 'name', 'slug', 'status')
            ->orderBy('name', 'asc')
            ->get();
    
        foreach ($categories as $key => $category) {
            $buttons = '';
    
            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="editFunc(' . $category->id . ')" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i></button>';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $category->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';
    
            $status = $category->status === 'active'
                ? '<div class="form-check form-switch">
                    <input class="form-check-input change-status" data-id="' . $category->id . '" type="checkbox" role="switch" checked>
                   </div>'
                : '<div class="form-check form-switch">
                    <input class="form-check-input change-status" data-id="' . $category->id . '" type="checkbox" role="switch">
                   </div>';
    
            $result['data'][$key] = [
                $category->name,
                $category->slug,
                $status,
                $buttons,
            ];
        }
    
        return response()->json($result);
    }

    public function updateStatus(Request $request)
    {
        $category = JobCategory::find($request->id);
    
        if ($category) {
            $category->status = $category->status === 'active' ? 'inactive' : 'active';
            $category->save();
    
            return response()->json(['message' => 'Status updated successfully', 'status' => $category->status]);
        }
    
        return response()->json(['message' => 'Job not found'], 404);
    }


    public function create(Request $request)
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Jobs Category List',
                'url' => route('professionalsList')
            ],
            [
                'label' => "Add Jobs Category",
                'url' => null 
            ]
        ];
        
        return view('admin.jobscategory.add',compact('breadcrumbs'));
        
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name',
            'status' => 'required|in:active,inactive',
            'slug' => 'nullable|string|unique:job_categories,slug',
        ]);

        try {
            $jobCategory = JobCategory::create([
                'name' => $validated['name'],
                'slug' => $validated['slug'] ?? \Str::slug($validated['name']),
                'status' => $validated['status'],
            ]);

            return response()->json(['status' => true, 'messages' => 'Job Category added successfully'], 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->getCode() == 23000) {
                return response()->json(['status' => false, 'error' => 'Category name already exists. Please choose a different name.'], 422);
            }

            return response()->json(['status' => false, 'error' => 'Something went wrong. Please try again.'], 500);
        }
    }



    

    public function edit(string $id)
    {
        $category = JobCategory::find($id);

        return response()->json(['category' => $category, 'status' => true], 200);
    }

    public function update(Request $request)
    {
        try {
            $rules = [
                'cat_id' => 'required|exists:job_categories,id',
                'edit_name' => 'required|string|min:3|max:255',
                'edit_status' => 'required|in:active,inactive',
            ];

            $messages = [
                'cat_id.exists' => 'Invalid category_id.',
                'edit_name.required' => 'The name field is required.',
                'edit_status.in' => 'Invalid status value.',
            ];

            $category = JobCategory::find($request->input('cat_id'));
            
            if (!$category) {
                return response()->json(['error' => 'Job Category not found']);
            }

            $request->validate($rules, $messages);

            // Update category details
            $slug = Str::slug($request->input('edit_name'));
            $category->update([
                'name' => $request->input('edit_name'),
                'slug' => $slug,
                'status' => $request->input('edit_status'),
            ]);

            return response()->json(['success' => true, 'messages' => 'Job Category updated successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            $errors = $validationException->errors();
            return response()->json(['error' => $errors, 'success' => false]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the record', 'success' => false]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $categoryId = $request->input('del_id');
            $category = JobCategory::find($categoryId);
    
            if (!$category) {
                return response()->json(['error' => false, 'messages' => 'Category not found']);
            }
    
            $category->delete();
    
            return response()->json(['success' => true, 'messages' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'messages' => 'Error deleting category']);
        }
    }


}
