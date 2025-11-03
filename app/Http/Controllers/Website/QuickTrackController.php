<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class QuickTrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
    public function index(Request $request)
    {
        return view('website.quick-track.index');
    }
}