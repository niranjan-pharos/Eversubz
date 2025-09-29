<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $newsletters = Newsletter::all();
        // return response()->json($newsletters);

        // newsletter
       
            $pageTitle = 'Newsletter';
            $breadcrumbs = [
                [
                    'label' => 'Dashboard',
                    'url' => route('adminDashboard')
                ],
                [
                    'label' => 'Newsletter',
                    'url' => null
                ],
            ];
            $Newsletters = Newsletter::all();
            // dd($Newsletter);
            return view('admin.newsletter.index',compact('Newsletters', 'pageTitle','breadcrumbs'));
        
        
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    

   

   
}
