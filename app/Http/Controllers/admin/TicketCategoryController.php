<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;
use Illuminate\Support\Facades\Auth;

class TicketCategoryController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Event Category',
                'url' => null
            ],
        ];
        return view('admin.events.ticket-category.index',compact('breadcrumbs'));
    }

    public function fetchTableData(){
        $result = ['data' => []];

        $categories = TicketCategory::select('id', 'name', 'slug','status')->get();

        foreach ($categories as $key => $category) {
            $buttons = ''; $status  =''; 

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="editFunc(' . $category->id . ')" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i></button>';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $category->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';

            if($category->status == 1) {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$category->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            }else{
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$category->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }

            $result['data'][$key] = [
                $category->name,
                $category->slug,
                $status,
                $buttons,
            ];
        }

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|min:3|max:255|unique:ticket_categories',
                'status' => 'required|in:0,1',
            ]);

            $name = $request->input('name');
            $slug = Str::slug($name);
            $status = $request->input('status');
            
            TicketCategory::create([
                'name' => $name,
                'slug' => $slug,
                'status' => $status,
            ]);

            return response()->json(['messages' => 'Event Ticket Category added successfully', 'status' => true], 200);
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
        $category = TicketCategory::find($id);

        return response()->json(['category' => $category, 'status' => true], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $rules = [
                'cat_id' => 'required|exists:ticket_categories,id',
                'edit_name' => 'required|string|min:3|max:255',
                'edit_status' => 'required|in:0,1',
            ];

            $messages = [
                'cat_id.exists' => 'Invalid category_id.',
                'edit_name.required' => 'The name field is required.',
                'edit_status.in' => 'Invalid status value.',
            ];

            $category = TicketCategory::find($request->input('cat_id'));
            
            if (!$category) {
                return response()->json(['error' => 'Event Category not found']);
            }

            $request->validate($rules, $messages);

            $slug = Str::slug($request->input('edit_name'));
            $category->update([
                'name' => $request->input('edit_name'),
                'slug' => $slug,
                'status' => $request->input('edit_status'),
            ]);

            return response()->json(['success' => true, 'messages' => 'Event Category updated successfully'], 200);
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
            $category = TicketCategory::find($categoryId);
    
            if (!$category) {
                return response()->json(['error' => false, 'messages' => 'Category not found']);
            }
    
            $category->delete();
    
            return response()->json(['success' => true, 'messages' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'messages' => 'Error deleting category']);
        }
    }

    public function changeStatus(Request $request){

        $category = TicketCategory::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();
        
        return response(['message' => 'status changed']);
    }

    public function searchCategory(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $categories = TicketCategory::where('name', 'like', '%' . $searchTerm . '%')->get();

        $result = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'text' => $category->name,
            ];
        });

        return response()->json($result);
    }
}
