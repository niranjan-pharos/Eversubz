<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventCategory;


class EventCategoryController extends Controller
{
    
    public function index(Request $request){
        $categories = EventCategory::where('status', '1')
                        ->select('id', 'name AS text')
                        ->get();

        return response()->json(['categories' => $categories]);

    }

    public function searchCategories(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $categories = EventCategory::where('name', 'LIKE', '%' . $searchTerm . '%')->where('status', 1)->get();

        return response()->json(['categories' => $categories]);
    }
}
