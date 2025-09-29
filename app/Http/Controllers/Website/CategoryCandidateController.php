<?php

namespace App\Http\Controllers\Website;

use App\Models\CategoryCandidate;
use Illuminate\Http\Request;
use App\Models\JobCategory;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class CategoryCandidateController extends Controller
{
    public function create()
    {
        $jobCategories = JobCategory::all();
        return view('category_candidates.create', compact('jobCategories'));
    }

    public function store(Request $request)
    {
        dd("Hii");
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'required|string|max:20',
            'category_id'=> 'required|exists:job_categories,id',
            'profession' => 'required|string|max:255',
            'dob'        => 'required|date',
            'education_json' => 'nullable|json',
            'permanent.address' => 'nullable|string|max:255',
            'permanent.city'    => 'nullable|string|max:255',
            'permanent.state'   => 'nullable|string|max:255',
            'permanent.country' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $candidate = new CategoryCandidate();
        $candidate->first_name = $request->first_name;
        $candidate->last_name = $request->last_name;
        $candidate->email = $request->email;
        $candidate->phone = $request->phone;
        $candidate->category_id = $request->category_id;
        $candidate->dob = $request->dob;
        $candidate->gender = $request->gender;
        $candidate->profession = $request->profession;
        $candidate->about = $request->about;
        $candidate->education = $request->education_json;
        $candidate->permanent_address = json_encode($request->permanent);
        $candidate->mailing_address = json_encode($request->mailing);
        $candidate->save();

        return response()->json(['success' => true]);
    }

    public function store1(Request $request)
    {
        dd($request->all());
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:category_candidates,email',
            'phone' => 'nullable|string|max:20',
            'category_id' => 'nullable|exists:job_categories,id',
            'about' => 'nullable|string',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'profession' => 'nullable|string|max:255',
            'education' => 'nullable|array',
            'education.*.degree' => 'required_with:education|string|max:255',
            'education.*.institute' => 'required_with:education|string|max:255',
            'education.*.field' => 'required_with:education|string|max:255',
            'education.*.from_date' => 'nullable|date',
            'education.*.to_date' => 'nullable|date',
            'education.*.ongoing' => 'nullable|boolean',
            'permanent.address' => 'nullable|string|max:255',
            'permanent.city' => 'nullable|string|max:100',
            'permanent.state' => 'nullable|string|max:100',
            'permanent.country' => 'nullable|string|max:100',
            'documents.*' => 'nullable|file|max:10240',
        ]);

        $candidate = new CategoryCandidate();
        $candidate->first_name = $validated['first_name'];
        $candidate->last_name = $validated['last_name'];
        $candidate->email = $validated['email'] ?? null;
        $candidate->phone = $validated['phone'] ?? null;
        $candidate->category_id = $validated['category_id'] ?? null;
        $candidate->about = $validated['about'] ?? null;
        $candidate->dob = $validated['dob'] ?? null;
        $candidate->gender = $validated['gender'] ?? null;
        $candidate->profession = $validated['profession'] ?? null;

        $candidate->education = $validated['education'] ?? null;

        $candidate->permanent_address = $validated['permanent']['address'] ?? null;
        $candidate->permanent_city = $validated['permanent']['city'] ?? null;
        $candidate->permanent_state = $validated['permanent']['state'] ?? null;
        $candidate->permanent_country = $validated['permanent']['country'] ?? null;

        if ($request->hasFile('documents')) {
            $files = [];
            foreach ($request->file('documents') as $file) {
                $path = $file->store('documents', 'public');
                $files[] = $path;
            }
            $candidate->documents = $files;
        }

        $candidate->save();

        return redirect()->back()->with('success', 'Candidate saved successfully!');
    }
}

