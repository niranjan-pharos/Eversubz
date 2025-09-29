<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\FaqSubcategory;
use Illuminate\Support\Str;

class FaqController extends Controller
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
        return view('admin.faq.index',compact('breadcrumbs'));
    }

    public function fetchTableData()
{
    $result = ['data' => []];

    // Fetch FAQs with related categories and subcategories
    $faqs = Faq::with(['category', 'subcategory'])->get();

    foreach ($faqs as $key => $faq) {
        $buttons = '';

        // Generate the Edit button with a link to the edit page (using the FAQ's slug)
        $buttons .= '<a href="' . route('faq.edit', $faq->slug) . '" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Edit</a>';

        // Add other buttons or actions as needed (e.g., Delete button)
        $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $faq->id . ')"><i class="fa fa-trash"></i> Delete</button>';

        // Add data for each row
        $result['data'][$key] = [
            $faq->question,
            $faq->slug,
            $faq->category->name, // Category name
            $faq->subcategory->name ?? 'N/A', // Subcategory name (if exists)
           
            $buttons, // Action buttons
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


    public function add(){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Faq Add',
                'url' => null
            ],
        ];

        $faqSubCategories = FaqSubcategory::with('category')->get(); // Get all FAQ subcategories with their related categories
        $faqCategories = FaqCategory::with('subcategories')->get(); // Get all FAQ categories
        return view('admin.faq.add_faq',compact('breadcrumbs', 'faqSubCategories', 'faqCategories'));
    }
    public function getSubcategories(Request $request)
{
    $categoryId = $request->category_id;

    // Fetch subcategories for the selected category
    $subcategories = FaqSubcategory::where('category_id', $categoryId)->get();

    if ($subcategories->isEmpty()) {
        return response()->json(['success' => false]);
    }

    return response()->json(['success' => true, 'subcategories' => $subcategories]);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'faq' => 'required|string|max:255',
        'category_id' => 'required|integer|exists:faq_categories,id',
        'subcategory_id' => 'nullable|integer|exists:faq_subcategories,id',
        'faq_description' => 'nullable|string', // Validate FAQ description
    ]);

    $faq = new Faq();
    $faq->question = $request->faq;
    $faq->slug = Str::slug($request->faq, '-'); // Generate slug from the question
    $faq->category_id = $request->category_id;
    $faq->subcategory_id = $request->subcategory_id;
    $faq->answer = $request->faq_description; // Store the description
    $faq->save();

    return response()->json(['success' => true, 'message' => 'FAQ added successfully!']);
}

public function uploadImage(Request $request)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath = public_path('uploads/summernote');
        
        if (!file_exists($filePath)) {
            mkdir($filePath, 0777, true);
        }
        
        $file->move($filePath, $fileName);
        $fileUrl = asset('uploads/summernote/' . $fileName);

        return response()->json(['success' => true, 'url' => $fileUrl]);
    }

    return response()->json(['success' => false, 'message' => 'No file uploaded.']);
}

    /**
     * Display the specified resource.
     */
    public function show($slug)
{
    // Find the FAQ by slug
    $breadcrumbs = [
        [
            'label' => 'Dashboard',
            'url' => route('adminDashboard')
        ],
        [
            'label' => 'Faq Add',
            'url' => null
        ],
    ];
    $faq = Faq::with(['category', 'subcategory'])->where('slug', $slug)->firstOrFail();
    // Pass the FAQ data to the view
    return view('admin.faq.view', compact('breadcrumbs', 'faq'));
}


    /**
     * Show the form for editing the specified resource.
     */
   // Display the FAQ edit form based on the slug
   public function edit($slug)
   {
    $breadcrumbs = [
        [
            'label' => 'Dashboard',
            'url' => route('adminDashboard')
        ],
        [
            'label' => 'Faq Add',
            'url' => null 
        ],
    ];
       $faq = Faq::where('slug', $slug)->firstOrFail(); // Find FAQ by slug
       $categories = FaqCategory::all(); // Fetch all categories for the select dropdown
       $subcategories = FaqSubcategory::where('category_id', $faq->category_id)->get(); // Fetch subcategories for selected category

       return view('admin.faq.edit', compact('breadcrumbs', 'faq', 'categories', 'subcategories'));
   }

   // Handle the FAQ update process
   // Handle the FAQ update process
   public function update(Request $request, $slug)
   {
       // Validate the request
       $request->validate([
           'question' => 'required|string|max:255',
           'category_id' => 'required|exists:faq_categories,id',
           'subcategory_id' => 'nullable|exists:faq_subcategories,id',
           'answer' => 'required|string', // Validate the answer field
       ]);

       // Find the FAQ by slug
       $faq = Faq::where('slug', $slug)->firstOrFail();

       // Automatically generate a new slug based on the question
       $newSlug = Str::slug($request->question);

       // Update the FAQ data
       $faq->update([
           'question' => $request->question,
           'slug' => $newSlug, // Set the new slug
           'category_id' => $request->category_id,
           'subcategory_id' => $request->subcategory_id,
           'answer' => $request->answer, // Save the answer
       ]);

       return response()->json(['success' => true, 'message' => 'FAQ updated successfully!']);
   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
