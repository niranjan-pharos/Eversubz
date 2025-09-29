<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\FaqSubcategory;

class HelpcenterController extends Controller
{
    public function index()
    {
        $faqCategories = FaqCategory::with(['subcategories' => function ($query) {
            $query->orderBy('name', 'asc'); // Sort subcategories alphabetically
        }])->orderBy('name', 'asc')->get(); // Sort categories alphabetically
    
        return view('website.helpcenter.index', compact('faqCategories'));
    }

    // public function show($slug)
    // {
    //     $faq = Faq::with(['category', 'subcategory'])->where('slug', $slug)->firstOrFail();
    //     return view('website.helpcenter.view', compact('faq'));
    // }
    public function subcategory($subcategorySlug){

        // Find the subcategory by slug
        $subcategory = FaqSubcategory::where('slug', $subcategorySlug)
            ->with(['faqs', 'category'])
            ->firstOrFail();

        // Fetch FAQ categories ordered alphabetically
        $faqCategories = FaqCategory::with(['subcategories' => function ($query) {
            $query->orderBy('name', 'asc'); // Sort subcategories alphabetically
        }])->orderBy('name', 'asc')->get();

        return view('website.helpcenter.view', compact('subcategory', 'faqCategories'));
    }

}
