<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaqCategory;
use App\Models\FaqSubcategory;
class FaqSubcategoryController extends Controller
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
                'label' => 'FAQ Category List',
                'url' => null
            ],
        ];
        $faqSubCategories = FaqSubcategory::with('category')->get(); // Get all FAQ subcategories with their related categories
        $faqCategories = FaqCategory::all(); // Get all FAQ categories

        return view('admin.faqsubcategory.index',compact('breadcrumbs', 'faqSubCategories', 'faqCategories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function fetchTableData()
    {
        $result = ['data' => []];
    
        // Fetch subcategories with their related categories
        $subcategories = FaqSubcategory::with('category')->select('id', 'name', 'slug', 'status', 'category_id')->get();
    
        foreach ($subcategories as $key => $subcategory) {
            $buttons = '';
            $status = '';
    
            // Add buttons for Edit and Delete
            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="editFunc(' . $subcategory->id . ')" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i></button>';
            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $subcategory->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';
    
            // Add status switch
            if ($subcategory->status == 1) {
                $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status" data-id="' . $subcategory->id . '" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            } else {
                $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status" data-id="' . $subcategory->id . '" type="checkbox" role="switch" id="flexSwitchCheckChecked"></div>';
            }
    
            // Add data for each row
            $result['data'][$key] = [
                $subcategory->name,
                $subcategory->slug,
                $subcategory->category->name, // Fetching the category name
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
        // Validate the incoming request data
        $validated = $request->validate([
            'category_id' => 'required|exists:faq_categories,id', // Ensures the category exists
            'name' => 'required|string|max:255', // Validate the subcategory name
            'status' => 'required|in:0,1', // Validate status (active or inactive)
        ]);
    
        // Create a new subcategory and assign the validated data
        $subcategory = new FaqSubcategory([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => \Str::slug($validated['name']), // Generate slug from the subcategory name
            'status' => $validated['status'],
        ]);
    
        // Save the subcategory to the database
        $subcategory->save();
    
        // Redirect or return response
        return redirect()->route('faqSubcategory')->with('success', 'Subcategory created successfully.');
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
