<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundraisingCategory;

class FundraisingCategoryController extends Controller
{
    //

    public function index(Request $request){
        $categories = FundraisingCategory::where('status', '1')
                        ->select('id', 'name AS text')
                        ->get();

        return response()->json(['categories' => $categories]);

    }

    public function getCategories(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $categories = FundraisingCategory::where('name', 'LIKE', '%' . $searchTerm . '%')->where('status', 1)->get();

        return response()->json(['categories' => $categories]);
    }
}
