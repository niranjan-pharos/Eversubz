<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\JobSkill;
use App\Models\JobTag;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Models\JobExperience;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class JobsController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Job List',
                'url' => null
            ],
        ];
        return view('admin.jobs.index',compact('breadcrumbs'));
    }


    public function fetchJobsData()
    {
        $result = ['data' => []];
    
        $jobs = Job::select('id', 'title', 'slug', 'company_name', 'address', 'category_id', 'city','status','created_at','updated_at')
            ->with(['category:id,name'])
            ->orderBy('id', 'desc')
            ->get();
    
        foreach ($jobs as $key => $job) {
            $buttons = '';
    
            $buttons .= '<a href="' . route('jobs.show', $job->slug) . '" class="btn btn-default btn-sm icon-btn"><i class="fa fa-eye"></i></a>';
            $buttons .= '<a class="dropdown-item" href="' . route('JobEdit', ['id' => $job->id]) . '" ><i class="fa fa-pencil m-r-5"></i></a>';
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" data-bs-toggle="modal" data-bs-target="#removeModal" onclick="removeFunc(\'' . $job->slug . '\')"><i class="fa fa-trash"></i></button>';
    
            $status = $job->status === 'active'
                ? '<div class="form-check form-switch">
                    <input class="form-check-input change-status" data-id="' . $job->id . '" type="checkbox" role="switch" checked>
                   </div>'
                : '<div class="form-check form-switch">
                    <input class="form-check-input change-status" data-id="' . $job->id . '" type="checkbox" role="switch">
                   </div>';
    
            $location = $job->address ? $job->address . ', ' . $job->city : $job->city;

            $result['data'][$key] = [
                $job->title,
                $job->company_name,
                $location,
                $job->category ? $job->category->name : '',
                $status,
                optional($job->created_at)->format('d-m-Y'),
                optional($job->updated_at)->format('d-m-Y'),
                $buttons,
            ];
        }
    
        return response()->json($result);
    }

    public function updateStatus(Request $request, $id)
    {
        $job = Job::find($id);
    
        if ($job) {
            $job->status = $job->status === 'active' ? 'inactive' : 'active';
            $job->save();
    
            return response()->json(['message' => 'Status updated successfully', 'status' => $job->status]);
        }
    
        return response()->json(['message' => 'Job not found'], 404);
    }


    public function create()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Job List',
                'url' => route('jobsList')
            ],
            [
                'label' => 'Add Job',
                'url' => null
            ],
        ];

        $categories = JobCategory::where('status','active')->get();
        $skills = Skill::where('status',0)->get();

        return view('admin.ngo.ngo_list',compact('breadcrumbs','categories','skills'));
    }

    public function store(Request $request)
    {
        $paymentTypes = config('jobs.payment_types', []);
        $experienceLevels = array_keys(config('jobs.experience_levels', []));
        $jobTypes = array_keys(config('jobs.job_modes', []));
        
        $validated = $request->validate([
            'job_title' => 'required|string|max:255', 
            'company_name' => 'nullable|string|max:255', 
            'category_id' => 'required|exists:job_categories,id',
            'address' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'experience_id' => ['required', Rule::in(array_keys(config('jobs.experience_levels')))],
            'salary' => 'nullable|numeric|min:0',
            'payment_type' => ['required', Rule::in(array_keys(config('jobs.payment_types')))],
            'job_mode' => ['required', Rule::in(array_keys(config('jobs.job_modes')))],
            'job_role' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'is_urgent' => 'nullable|boolean', 
            'image' => 'nullable|image|max:5120',
        ], [
            'image.max' => 'The image size cannot exceed 5MB.',
        ]);
        
        $jobData = [
            'title' => $validated['job_title'],
            'company_name' => $validated['company_name'],
            'category_id' => $validated['category_id'],
            'address' => $validated['address'] ?? null,
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
            'is_featured' => $validated['is_featured'] ?? 0, 
            'is_urgent' => $validated['is_urgent'] ?? 0,  
            'expires_at' => now()->addDays(config('jobs.job_expiry_days')), 
            'created_by_admin' => 1,
        ];       

        
        if ($request->hasFile('image')) {
            $jobData['image'] = $request->file('image')->store('jobs', 'public');
        }

        
        $job = Job::create($jobData);

        if (!empty($validated['tags'])) {
            foreach ($validated['tags'] as $tagName) {
                JobTag::create([
                    'tag_name' => $tagName,
                    'job_id' => $job->id,
                ]);
            }
        }

        
        if (!empty($validated['skills'])) {
            foreach ($validated['skills'] as $skillId) {
                JobSkill::create([
                    'skill_id' => $skillId, 
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



    public function show($slug)
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Jobs List',
                'url' => route('jobsList')
            ],
            [
                'label' => 'Job Details',
                'url' => null
            ],
        ];
        $job = Job::where('slug', $slug)
            ->with(['category', 'user', 'skills', 'tags']) 
            ->with('applications')
            ->firstOrFail();
    
        return view('admin.jobs.viewjob', compact('breadcrumbs', 'job'));
    }

   
    public function downloadResume($file)
    {
        $filePath = storage_path('app/public/candidates/' . $file);
        
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return response()->json(['status' => 'error', 'message' => 'File not found'], 404);
        }
    }

    
    public function edit($id)
    {
        $job = Job::with(['category', 'skills', 'tags'])->find($id);
        
        if (!$job) {
            return redirect()->route('jobsList')->with('error', 'Job not found.');
        }

        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Job List',
                'url' => route('jobsList')
            ],
            [
                'label' => 'Edit Job: ' . $job->job_title,
                'url' => null
            ],
        ];

        return view('admin.jobs.edit', compact('breadcrumbs', 'job'));
    }

    public function update(Request $request, $id)
    {
        $paymentTypes = config('jobs.payment_types', []);
        $experienceLevels = array_keys(config('jobs.experience_levels', []));
        $jobTypes = array_keys(config('jobs.job_modes', []));

        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'category_id' => 'required|exists:job_categories,id',
            'address' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'experience_id' => ['required', Rule::in(array_keys(config('jobs.experience_levels')))],
            'salary' => 'nullable|numeric|min:0',
            'payment_type' => ['required', Rule::in(array_keys(config('jobs.payment_types')))],
            'job_mode' => ['required', Rule::in(array_keys(config('jobs.job_modes')))],
            'job_role' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'is_urgent' => 'nullable|boolean',
            'image' => 'nullable|image|max:5120',
            'existing_image' => 'nullable|string', 
        ], [
            'image.max' => 'The image size cannot exceed 5MB.',
        ]);

        $job = Job::findOrFail($id);

        $jobData = [
            'title' => $validated['job_title'],
            'company_name' => $validated['company_name'],
            'category_id' => $validated['category_id'],
            'address' => $validated['address'] ?? null,
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
            'is_featured' => $validated['is_featured'] ?? 0,
            'is_urgent' => $validated['is_urgent'] ?? 0,
        ];

        
        if ($request->hasFile('image')) {
            if ($job->image && \Storage::disk('public')->exists($job->image)) {
                \Storage::disk('public')->delete($job->image);
            }
            $jobData['image'] = $request->file('image')->store('jobs', 'public');
        } else if (!empty($validated['existing_image'])) {
            $jobData['image'] = $validated['existing_image'];
        } else {
            $jobData['image'] = null;
        }

        $job->update($jobData);

        JobTag::where('job_id', $job->id)->delete();
        if (!empty($validated['tags'])) {
            foreach ($validated['tags'] as $tagName) {
                JobTag::create([
                    'tag_name' => $tagName,
                    'job_id' => $job->id,
                ]);
            }
        }

        JobSkill::where('job_id', $job->id)->delete();
        if (!empty($validated['skills'])) {
            foreach ($validated['skills'] as $skillId) {
                JobSkill::create([
                    'skill_id' => $skillId,
                    'job_id' => $job->id,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Job updated successfully!',
            'data' => $job,
        ]);
    }


    public function destroy(Request $request)
    {
        $slug = $request->del_id;

        $job = Job::where('slug', $slug)->with(['tags', 'skills'])->first();

        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        $job->tags()->delete();

        $job->skills()->delete();

        if ($job->image) {
            Storage::disk('public')->delete($job->image);
        }

        $job->delete();

        return response()->json(['success' => true, 'message' => 'Job and its associated data deleted successfully']);
    }


    public function searchCategory(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $categories = JobCategory::where('name', 'like', '%' . $searchTerm . '%')
                                ->where('status', 'active')
                                ->get();

        $result = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'text' => $category->name,
            ];
        });

        return response()->json($result);
    }

    public function changeJobStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:jobs,id', 
            'status' => 'required|in:1,0,true,false',
        ]);

        try {
            $job = Job::find($request->id);

            if ($job) {
                $newStatus = filter_var($request->status, FILTER_VALIDATE_BOOLEAN) ? 'active' : 'inactive';

                $job->status = $newStatus;
                $job->save();

                return response()->json([
                    'message' => 'Job status changed successfully.',
                    'status' => $newStatus
                ]);
            } else {
                return response()->json(['error' => 'Job not found'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error updating job status', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while updating the status.'], 500);
        }
    }


}
