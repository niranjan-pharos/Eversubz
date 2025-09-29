<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Models\CategoryCandidate;
use App\Models\Fundraising;

class CategoryCandidatesController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'email'             => 'nullable|email|max:255',
            'phone'             => 'nullable|string|max:20',
            'category_id'       => 'nullable|exists:job_categories,id',
            'profession'        => 'nullable|string|max:255',
            'dob'               => 'nullable|date',
            'gender'            => 'nullable|string|in:Male,Female,Other',
            'education_json'    => 'nullable|json',
            'fundraising_slug'  => 'nullable|string|exists:fundraising,slug',
            'permanent.address' => 'nullable|string|max:255',
            'permanent.city'    => 'nullable|string|max:255',
            'permanent.state'   => 'nullable|string|max:255',
            'permanent.country' => 'nullable|string|max:255',
            'documents.*'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB max
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $candidate = new CategoryCandidate();
        $candidate->first_name  = $request->first_name;
        $candidate->last_name   = $request->last_name;
        $candidate->email       = $request->email;
        $candidate->phone       = $request->phone;
        $candidate->category_id = $request->category_id;
        $candidate->profession  = $request->profession;
        $candidate->dob         = $request->dob;
        $candidate->gender      = $request->gender;
        $candidate->about       = $request->about;

        // Education JSON
        $candidate->education = $request->education_json;

        // Fundraising ID from slug
        if ($request->fundraising_slug) {
            $fundraising = Fundraising::where('slug', $request->fundraising_slug)->first();
            if ($fundraising) {
                $candidate->fundraising_id = $fundraising->id;
            }
        }

        // Permanent address spread into separate fields
        if ($request->permanent) {
            $candidate->permanent_address = $request->permanent['address'] ?? null;
            $candidate->permanent_city    = $request->permanent['city'] ?? null;
            $candidate->permanent_state   = $request->permanent['state'] ?? null;
            $candidate->permanent_country = $request->permanent['country'] ?? null;
        }

        // Save candidate first to get ID for file paths
        $candidate->save();

        // Handle multiple documents
        if ($request->hasFile('documents')) {
            $files = [];
            foreach ($request->file('documents') as $file) {
                // Create a unique filename
                $filename = time() . '_' . $file->getClientOriginalName();
                // Store in 'category_images' folder inside 'public' disk
                $file->storeAs('category_images', $filename, 'public');
                $files[] = $filename;
            }
            $candidate->documents = json_encode($files);
            $candidate->save();
        }

        return response()->json(['success' => true, 'message' => 'Candidate saved successfully!']);
    }



}
