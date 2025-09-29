<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function newslettersubmitForm(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:newsletter',
        ]);
    
        Newsletter::create([
            'email' => $request->email,
        ]);
    
        return response()->json(['message' => 'Subscription successful'], 200);
    }


    // public function newslettersubmitForm(Request $request)
    // {
    //     $request->validate([
            
    //         'email' => 'required|email|max:255',
            
    //     ]); 

    //     // Create a new contact record using the Contact model
    //     Newsletter::create([
           
    //         'email' => $request->email,
           
    //     ]);

    //     // Optionally, you can redirect the user after form submission
    //     return redirect()->back()->with('success', 'Your message has been submitted successfully!');
    // }

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
