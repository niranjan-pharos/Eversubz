<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaqCategory;
use App\Models\FaqSubcategory;
use Illuminate\Support\Facades\Validator;
use Str;
use Illuminate\Support\Facades\Auth;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'FAQ Category List',
                'url' => null
            ],
        ];
        return view('admin.faqcategory.index',compact('breadcrumbs'));
    }

    public function fetchTableData(){
        $result = ['data' => []];

        $categories = FaqCategory::select('id', 'name', 'slug','status')->get();

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
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:faq_categories,name',
            'status' => 'required|boolean',
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput(); // Preserve input in case of error
        }
    
        try {
            // Create a new category
            FaqCategory::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'status' => $request->status,
            ]);
    
            return redirect()
                ->route('faqCategory')
                ->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            \Log::error('Error creating category: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'An unexpected error occurred. Please try again.');
        }
    }
    
    public function changeStatus(Request $request)
{
    try {
        // Ensure that the id and status are being passed correctly
        $category = FaqCategory::findOrFail($request->id);

        // Check if the status is passed as a boolean (true/false)
        $status = $request->status == 'true' ? 1 : 0;

        // Update the status
        $category->status = $status;
        $category->save();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    } catch (\Exception $e) {
        // Log any errors and return a failure response
        \Log::error('Error updating status: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Failed to update status.']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
