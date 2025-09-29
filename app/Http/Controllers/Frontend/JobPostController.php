<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\JobSkill;
use App\Models\JobTag;
use App\Models\Skill;
use App\Models\JobExperience;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class JobPostController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'You need to login first.');
        }
        
        $userId = Auth::id();
        $user = Auth::user();
        $perPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION'));

        $jobs = Job::with('category') 
                    ->where('user_id', Auth::id())
                    ->orderBy('id', 'desc')
                    ->paginate($perPage);

        $totalJobs = Job::where('user_id', $userId)->count();

        $is_approved = ($user->status == 1) ? 1 : 0;

        return view('frontend.jobs.index', compact('jobs', 'totalJobs', 'is_approved'));
    }


    public function create()
    {
        $categories = JobCategory::where('status','active')->get();
        $skills = Skill::where('status',0)->get();

        return view('frontend.jobs.create', compact('categories','skills'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $paymentTypes = config('jobs.payment_types', []);
        $experienceLevels = array_keys(config('jobs.experience_levels', []));
        $jobTypes = array_keys(config('jobs.job_modes', []));

        $validated = $request->validate([
            'title' => 'required|string|max:255', 
            'company_name' => 'required|string|max:255', 
            'category_id' => 'required|exists:job_categories,id',
            'location_id' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'skills' => 'nullable|array',
            'skills.*' => 'string',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'experience_id' => ['required', Rule::in(array_keys(config('jobs.experience_levels')))],
            'salary' => 'nullable|numeric|min:0',
            'payment_type' => ['required', Rule::in(array_keys(config('jobs.payment_types')))],
            'job_mode' => ['required', Rule::in(array_keys(config('jobs.job_modes')))],
            'job_role' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $jobData = [
            'title' => $validated['title'],
            'company_name' => $validated['company_name'],
            'category_id' => $validated['category_id'],
            'address' => $validated['location_id'] ?? null,
            'city' => $validated['city'],
            'state' => $validated['state'],
            'country' => $validated['country'],
            'description' => $validated['description'],
            'requirements' => $validated['requirements'] ?? null,
            'experience' => $validated['experience_id'],
            'job_role' => $validated['job_role'],
            'salary' => $validated['salary'] ?? null,
            'payment_type' => $validated['payment_type'] ?? null,
            'job_mode' => $validated['job_mode'] ?? null,
            'status' => 'active',
            'expires_at' => now()->addDays(config('jobs.job_expiry_days')),
            'user_id' => auth()->id(),
        ];

        if ($request->hasFile('image')) {
            $jobData['image'] = $request->file('image')->store('jobs', 'public');
        }

        $job = Job::create($jobData);

        // Handle tags
        if (!empty($validated['tags'])) {
            foreach ($validated['tags'] as $tagName) {
                JobTag::create([
                    'tag_name' => $tagName,
                    'job_id' => $job->id,
                ]);
            }
        }

        // Handle skills
        if (!empty($validated['skills'])) {
            foreach ($validated['skills'] as $skillName) {
                // Check if the skill exists in the `skills` table
                $skill = Skill::firstOrCreate(['skill_name' => $skillName]);

                // Create the relationship in the `job_skills` table
                JobSkill::create([
                    'skill_id' => $skill->id,
                    'job_id' => $job->id,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Job created successfully!',
            'data' => $job,
        ]);
    }




    public function edit($slug){
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $job = Job::where('slug', $slug)->with(['tags', 'skills'])->first();
    
        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        if ($job->status !== 'active') {
            return response()->json(['error' => 'Job is no longer active'], 403);
        }
    
        if ($job->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $categories = JobCategory::where('status','active')->get();  

        $skills = Skill::where('status',1)->get(); 
    
        return view('frontend.jobs.edit', compact('job','categories','skills'));
    }


    public function update(Request $request, $slug)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $job = Job::where('slug', $slug)->first();

        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        if ($job->status !== 'active') {
            return response()->json(['error' => 'Job is no longer active'], 403);
        }

        if ($job->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $paymentTypes = config('jobs.payment_types', []);
        $experienceLevels = array_keys(config('jobs.experience_levels', []));
        $jobTypes = array_keys(config('jobs.job_modes', []));
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'category_id' => 'required|exists:job_categories,id',
            'location_id' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'skills' => 'nullable|array',
            'skills.*' => 'string',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'experience_id' => ['required', Rule::in($experienceLevels)],
            'salary' => 'nullable|numeric|min:0',
            'payment_type' => ['nullable', 'string', Rule::in(array_keys($paymentTypes))],
            'job_mode' => ['nullable', 'string', Rule::in(array_keys(config('jobs.job_modes')))],
            'job_role' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        // Update job data
        $job->update([
            'title' => $validated['title'],
            'company_name' => $validated['company_name'],
            'category_id' => $validated['category_id'],
            'address' => $validated['location_id'] ?? null,
            'city' => $validated['city'],
            'state' => $validated['state'],
            'country' => $validated['country'],
            'description' => $validated['description'],
            'requirements' => $validated['requirements'] ?? null,
            'experience' => $validated['experience_id'],
            'job_role' => $validated['job_role'],
            'salary' => $validated['salary'] ?? null,
            'payment_type' => $validated['payment_type'] ?? null,
            'job_mode' => $validated['job_mode'] ?? null,
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($job->image) {
                Storage::disk('public')->delete($job->image);
            }
            $job->image = $request->file('image')->store('jobs', 'public');
            $job->save();
        }

        // Update tags
        $job->tags()->delete();
        if (!empty($validated['tags'])) {
            foreach ($validated['tags'] as $tagName) {
                JobTag::create([
                    'tag_name' => $tagName,
                    'job_id' => $job->id,
                ]);
            }
        }

        // Update skills
        $job->skills()->detach(); // Remove all associated skills first

        if (!empty($validated['skills'])) {
            foreach ($validated['skills'] as $skillNameOrId) {
                if (is_numeric($skillNameOrId)) {
                    // If the skill is already in the database, attach it by ID
                    $job->skills()->attach($skillNameOrId);
                } else {
                    $skill = Skill::firstOrCreate(['skill_name' => $skillNameOrId]);
                    $job->skills()->attach($skill->id);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Job updated successfully!',
            'data' => $job,
        ]);
    }

    public function destroy($slug)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $job = Job::where('slug', $slug)->with(['tags', 'skills'])->first();

        if (!$job) {
            if (request()->ajax()) {
                return response()->json(['error' => 'Job not found'], 404);
            }
            return redirect()->route('jobs.list')->with('error', 'Job not found.');
        }

        if ($job->user_id !== auth()->id()) {
            return response()->json(['error' => 'You do not have permission to delete this job'], 403);
        }

        $job->tags()->delete();
        $job->skills()->delete();

        if ($job->image) {
            Storage::disk('public')->delete($job->image);
        }

        $job->delete();

        return response()->json(['success' => true, 'message' => 'Job and its associated data deleted successfully']);
    }


    public function showJobApplications($jobId)
    {
        $registeredCandidates = DB::table('job_applications')
            ->join('users', 'job_applications.user_id', '=', 'users.id')
            ->where('job_id', $jobId)
            ->select('job_applications.*', 'job_applications.cover_letter', 'users.name', 'users.email')
            ->get();

        $guestCandidates = DB::table('guest_job_applications')
            ->where('job_id', $jobId)
            ->select('guest_job_applications.*', 'guest_job_applications.resume')
            ->get();

        return view('frontend.jobs.job_applied_candidate', compact('registeredCandidates', 'guestCandidates'));
    }

    public function getCandidateDetails($id, $type)
    {
        if ($type === 'registered') {
            $candidate = DB::table('job_applications')
                ->join('users', 'job_applications.user_id', '=', 'users.id')
                ->where('job_applications.id', $id)
                ->select('users.name', 'users.email', 'job_applications.cover_letter')
                ->first();
        } else {
            $candidate = DB::table('guest_job_applications')
                ->where('id', $id)
                ->select('name', 'email', 'resume')
                ->first();
        }

        $html = view('partials.candidate-details', compact('candidate'))->render();

        return response()->json(['html' => $html]);
    }

    
    
}
