<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\JobSkill;
use App\Models\Skill;
use App\Models\JobExperience;
use App\Models\GuestJobApplication;
use App\Models\JobTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Pagination\LengthAwarePaginator;


class JobsController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'categories' => 'nullable|array',
            'categories.*' => 'string|exists:job_categories,slug', 
            'skills' => 'nullable|array',
            'skills.*' => 'string|exists:skills,slug', 
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:255',
            'experiences' => 'nullable|array',
            'experiences.*' => 'string|in:' . implode(',', array_keys(config('jobs.experience_levels'))),
            'keyword' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'job_types' => 'nullable|array',
            'job_types.*' => 'string|in:' . implode(',', array_keys(config('jobs.job_modes'))),
        ]);

        $isAuthenticated = Auth::check();
        $isVerified = $isAuthenticated ? Auth::user()->hasVerifiedEmail() : false;
        $is_module_visible = $isAuthenticated ? (Auth::user()->is_module_visible == 1) : false;

        if ($isAuthenticated && !$is_module_visible) {
            return redirect()->route('user.pending-approval');
        }

        if ($isAuthenticated && $isVerified && $is_module_visible) {
            $categoriesFilter = $request->input('categories', []); 
            $skillsFilter = $request->input('skills', []); 
            $tagsFilter = $request->input('tags', []); 
            $experiencesFilter = $request->input('experiences', []); 
            $keyword = $request->input('keyword'); 
            $location = $request->input('location'); 
            $jobTypes = $request->input('job_types', []); 

            $categorySlugs = JobCategory::whereIn('slug', $categoriesFilter)->pluck('id')->toArray(); 
            $skillSlugs = Skill::whereIn('slug', $skillsFilter)->pluck('id')->toArray(); 

            $jobs = Job::query()
                ->with(['category', 'skills', 'tags'])
                ->where('status', 'active')
                ->with('applications')
                ->when($categorySlugs, function ($query) use ($categorySlugs) {
                    $query->whereIn('category_id', $categorySlugs);
                })
                ->when($skillSlugs, function ($query) use ($skillSlugs) {
                    $query->whereHas('skills', function ($subQuery) use ($skillSlugs) {
                        $subQuery->whereIn('skills.id', $skillSlugs); 
                    });
                })
                ->when($tagsFilter, function ($query) use ($tagsFilter) {
                    $query->whereHas('tags', function ($subQuery) use ($tagsFilter) {
                        $subQuery->whereIn('tag_name', $tagsFilter); 
                    });
                })
                ->when($experiencesFilter, function ($query) use ($experiencesFilter) {
                    $query->whereIn('experience', $experiencesFilter); 
                })
                ->when($keyword, function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', '%' . e($keyword) . '%');
                })
                ->when($location, function ($query) use ($location) {
                    $query->where(function ($subQuery) use ($location) {
                        $subQuery->where('city', 'LIKE', '%' . e($location) . '%')
                            ->orWhere('state', 'LIKE', '%' . e($location) . '%')
                            ->orWhere('country', 'LIKE', '%' . e($location) . '%');
                    });
                })
                ->when($jobTypes, function ($query) use ($jobTypes) {
                    $query->whereIn('job_mode', $jobTypes); 
                })
                ->paginate(config('constants.DEFAULT_PAGINATION', 10));

            $categories = Cache::remember('job_categories', 3600, fn() => JobCategory::where('status', 'active')->get());
            $skills = Cache::remember('job_skills', 3600, function () {
                return Skill::where('status', 1)
                    ->select('id', 'skill_name', 'slug')
                    ->distinct()
                    ->get(); 
            });
            $tags = Cache::remember('job_tags', 3600, function () {
                return JobTag::select('id', 'tag_name')->distinct()->get();
            });
        } else {
            $jobs = new LengthAwarePaginator([], 0, config('constants.DEFAULT_PAGINATION', 10));
            $categories = collect();
            $skills = collect();
            $tags = collect();
        }

        $experienceLevels = config('jobs.experience_levels');
        $jobModes = config('jobs.job_modes'); 

        return view('website.jobs.jobs-listing', compact(
            'jobs', 
            'categories', 
            'skills', 
            'tags', 
            'experienceLevels', 
            'jobModes',
            'isAuthenticated',
            'isVerified',
        ));
    }





    public function details($slug)
    {
        $job = Job::with(['category', 'skills', 'tags'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $user = auth()->user();

        $alreadyApplied = false;


        if ($user) {
            $alreadyApplied = DB::table('job_applications')
                ->where('user_id', $user->id)
                ->where('job_id', $job->id)
                ->exists();
        }

        $isAuthenticated = Auth::check();
        $isVerified = $isAuthenticated ? Auth::user()->hasVerifiedEmail() : false;
        $is_module_visible = $isAuthenticated ? (Auth::user()->is_module_visible == 1) : false;

        if ($isAuthenticated && !$is_module_visible) {
            return redirect()->route('user.pending-approval');
        }
        
        return view('website.jobs.job-details', compact('job', 'alreadyApplied'));
    }



    public function candidatelist(){
        $isAuthenticated = Auth::check();
        $isVerified = $isAuthenticated ? Auth::user()->hasVerifiedEmail() : false;
        $is_module_visible = $isAuthenticated ? (Auth::user()->is_module_visible == 1) : false;

        if ($isAuthenticated && !$is_module_visible) {
            return redirect()->route('user.pending-approval');
        }
        return view('website.jobs.candidate-listing');

    }

    
    public function candidatedetails(){
        $isAuthenticated = Auth::check();
        $isVerified = $isAuthenticated ? Auth::user()->hasVerifiedEmail() : false;
        $is_module_visible = $isAuthenticated ? (Auth::user()->is_module_visible == 1) : false;

        if ($isAuthenticated && !$is_module_visible) {
            return redirect()->route('user.pending-approval');
        }
        return view('website.jobs.candidate-details');

    }

    public function applyJob(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'You need to login first.'], 401);
        }

        $jobId = decrypt($request->input('jobId'));

        $user = auth()->user();

        $isJobOwner = DB::table('jobs')
            ->where('id', $jobId)
            ->where('user_id', $user->id)
            ->exists();

        if ($isJobOwner) {
            return response()->json(['message' => 'You cannot apply for your own job posting.'], 403);
        }

        $alreadyApplied = DB::table('job_applications')
            ->where('user_id', $user->id)
            ->where('job_id', $jobId)
            ->exists();
        
        if ($alreadyApplied) {
            return response()->json(['message' => 'You have already applied for this job.'], 409);
        }

        $request->validate([
            'cover_letter' => 'required|string|min:50',
        ]);

        $isAuthenticated = Auth::check();
        $isVerified = $isAuthenticated ? Auth::user()->hasVerifiedEmail() : false;
        $is_module_visible = $isAuthenticated ? (Auth::user()->is_module_visible == 1) : false;

        if ($isAuthenticated && !$is_module_visible) {
            return redirect()->route('user.pending-approval');
        }

        DB::table('job_applications')->insert([
            'user_id' => $user->id,
            'job_id' => $jobId,
            'cover_letter' => $request->input('cover_letter'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your application has been successfully submitted.'
        ]);
    }


    public function guestApplyJob(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:guest_job_applications,email',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $jobId = decrypt($request->input('jobId'));

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('resume')) {
            $filePath = $request->file('resume')->store('candidates', 'public');
        }

        $isAuthenticated = Auth::check();
        $isVerified = $isAuthenticated ? Auth::user()->hasVerifiedEmail() : false;
        $is_module_visible = $isAuthenticated ? (Auth::user()->is_module_visible == 1) : false;

        if ($isAuthenticated && !$is_module_visible) {
            return redirect()->route('user.pending-approval');
        }

        DB::table('guest_job_applications')->insert([
            'job_id' => $jobId,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'resume' => $filePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Guest application submitted successfully!',
        ], 200);
    }


}
