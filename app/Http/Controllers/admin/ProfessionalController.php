<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CandidateProfile;
use App\Models\CandidateLanguage;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\JobCategory;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Str;
use HTMLPurifier;
use HTMLPurifier_Config;

class ProfessionalController extends Controller
{
    public function index()
    {
        $users = User::with('candidateProfile')->get();

        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Professionals List',
                'url' => null
            ],
        ];
        return view('admin.professionals.index', compact('breadcrumbs'));
    }

    public function fetchTableData()
    {
        $result = ['data' => []];

        $professionals = User::where('account_type', 4)
            ->with([
                'candidateProfile.skills', 
                'candidateProfile.educations',
                'candidateProfile.candidateLanguages',
                'candidateProfile.categories',
            ])
            ->get();

            foreach ($professionals as $professional) {
                $image = $professional->image
                    ? '<img src="' . asset('storage/' . $professional->image) . '" alt="' . e($professional->name) . '" class="img-thumbnail" style="max-width:50px; max-height:50px;">'
                    : '<img src="' . asset('images/default-user.png') . '" alt="No Image" class="img-thumbnail" style="max-width:50px; max-height:50px;">';
            
                $buttons = '';
                $buttons .= '<a href="' . route('editProfessionalData', ['id' => $professional->id]) . '" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil" title="Edit Professional"></i></a>';
                $buttons .= '<a href="' . route('professionals.show', ['id' => $professional->id]) . '" type="button" class="btn btn-default btn-sm" ><i class="fa fa-eye" title="Show Professional"></i></a>';
                $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $professional->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';
            
                $result['data'][] = [
                    $image,
                    $professional->id,
                    $professional->name,
                    $professional->email,
                    $professional->candidateProfile->profession ?? '-', 
                    $professional->candidateProfile->salary ?? '-', 
                    '<div class="form-check form-switch">
                        <input 
                            class="form-check-input change-user-status" 
                            type="checkbox" 
                            data-id="' . $professional->id . '" 
                            ' . ($professional->status === 'active' ? 'checked' : '') . '>
                    </div>',
                    $buttons,
                ];
            }            

        return response()->json($result);
    }

    public function add(Request $request){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Professional List',
                'url' => route('professionalsList')
            ],
            [
                'label' => "Add Professional By Admin",
                'url' => null 
            ]
        ];
        $allSkills = Skill::where('status', 1)->get();
        $jobCategories = JobCategory::where('status', 'active')->get();
        
        return view('admin.professionals.add_professional',compact('breadcrumbs','allSkills','jobCategories'));
    }


    public function storeProfessional(Request $request)
    {
        DB::beginTransaction();
        try {
            $skills = collect($request->input('skills', []))
                    ->filter(fn($skill) => isset($skill['id']) && !empty($skill['id']))
                    ->toArray();

            $request->merge(['skills' => $skills]);

            $validator = Validator::make($request->all(), [
                'username' => 'nullable|string|max:255',
                'name' => 'nullable|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'phone' => 'nullable|string|max:20|unique:users,phone',
                'categories' => 'nullable|array',
                'categories.*' => 'integer',
                'gender' => 'nullable|in:Male,Female,Other',
                'profession' => 'nullable|string|max:255',
                'linkedin' => 'nullable|url',
                'github' => 'nullable|url',
                'website_url' => 'nullable|url',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
                
                'skills' => 'nullable|array',
                'skills.*.id' => 'integer|exists:skills,id',
                'skills.*.proficiency_level' => 'nullable|in:beginner,intermediate,expert',

                'languages' => 'nullable|array',
                'languages.*.language_name' => 'nullable|string|max:255',
                'languages.*.proficiency_level' => 'nullable|in:Basic,Fluent,Native',

                'educations' => 'nullable|array',
                'educations.*.degree' => 'nullable|string|max:255',
                'educations.*.institution' => 'nullable|string|max:255',
                'educations.*.field_of_study' => 'nullable|string|max:255',
                'educations.*.from_date' => 'nullable|date',
                'educations.*.to_date' => 'nullable|date|after_or_equal:educations.*.from_date',

                'experiences' => 'nullable|array',
                'experiences.*.job_title' => 'nullable|string|max:255',
                'experiences.*.company' => 'nullable|string|max:255',
                'experiences.*.from_date' => 'nullable|date',
                'experiences.*.to_date' => 'nullable|date|after_or_equal:experiences.*.from_date', 
                'experiences.*.description' => 'nullable|string',
                'experiences.*.location' => 'nullable|string',
                'experiences.*.job_type' => 'nullable|string|max:255',
                'experiences.*.portfolio_url' => 'nullable|url|max:255',

                
                'permanent_address' => 'nullable|string',
                'mailing_address' => 'nullable|string',
                'resume' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:5021',

                'permanent_city' => 'nullable|string|max:255',
                'permanent_state' => 'nullable|string|max:255',
                'permanent_country' => 'nullable|string|max:255',
                'mailing_city' => 'nullable|string|max:255',
                'mailing_state' => 'nullable|string|max:255',
                'mailing_country' => 'nullable|string|max:255',

                'about' => 'nullable|string',
                'salary' => 'nullable|string|max:255',
                'dob' => 'nullable|date|before:today', 
            ], [
                'email.required' => 'The email address is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email is already registered.',
                'phone.unique' => 'This phone number is already registered.',
                'skills.*.id.exists' => 'Selected skill does not exist in our database.',
                'skills.*.proficiency_level.in' => 'Proficiency level must be one of the following: beginner, intermediate, expert.',
                'languages.*.language_name.max' => 'Language name cannot be longer than 255 characters.',
                'languages.*.proficiency_level.in' => 'Proficiency level must be one of the following: Basic, Fluent, Native.',
                'educations.*.to_date.after_or_equal' => 'End date cannot be earlier than start date.',
                'experiences.*.to_date.after_or_equal' => 'End date cannot be earlier than start date.',
                'resume.mimes' => 'The resume must be a file of type: pdf, jpeg, png, jpg.',
                'resume.max' => 'The resume file size cannot exceed 5MB.',
                'profile_image.max' => 'The image size cannot exceed 5MB.',
                'profile_image.mimes' => 'The profile image must be a file of type: jpeg, png, jpg, gif, svg, webp.',
                'profile_image.image' => 'The profile image must be a valid image file.',
                'dob.before' => 'The date of birth must be before today.',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $validatedData = $validator->validated();

            $user = User::create([
                'username' => $validatedData['username'],
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'] ?? null,
                'gender' => $validatedData['gender'] ?? null,
                'password' => bcrypt(Str::random(16)),
                'address' => $validatedData['permanent_address'] ?? null,
                'permanent_city' => $validatedData['permanent_city'] ?? null,
                'permanent_state' => $validatedData['permanent_state'] ?? null,
                'permanent_country' => $validatedData['permanent_country'] ?? null,
                'account_type' => 4,
                'is_admin_approved' => 1,
            ]);

            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $filename = $file->hashName();
                $path = $file->storeAs('profile_images', $filename, 'public');
                $user->image = 'profile_images/' . $filename;
                $user->save();

                $thumbnailPath = 'profile_images/thumb/' . $filename;
                $thumbnailImage = Image::make($file->getRealPath())
                    ->resize(200, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                Storage::disk('public')->put($thumbnailPath, (string)$thumbnailImage->encode());
            }

            $candidateProfileData = [
                'user_id' => $user->id,
                'profession' => $validatedData['profession'] ?? null,
                'about' => $validatedData['about'] ?? null,
                'address' => $validatedData['mailing_address'] ?? null,
                'dob' => $validatedData['dob'] ?? null,
                'gender' => $validatedData['gender'] ?? null,
                'salary' => $validatedData['salary'] ?? null,
                'city' => $validatedData['mailing_city'] ?? null,
                'state' => $validatedData['mailing_state'] ?? null,
                'country' => $validatedData['mailing_country'] ?? null,
                'linkedin_url' => $validatedData['linkedin'] ?? null,
                'github_url' => $validatedData['github'] ?? null,
                'website_url' => $validatedData['website_url'] ?? null,
            ];
            $candidateProfile = $user->candidateProfile()->create($candidateProfileData);

            if ($request->has('categories') && is_array($request->categories)) {
                $candidateProfile->categories()->sync($request->categories);
            } else {
                $candidateProfile->categories()->sync([]);
            }

            if ($request->hasFile('resume')) {
                $resumePath = $request->file('resume')->store('candidates', 'public');
                $candidateProfile->update(['resume' => $resumePath]);
            }


            if (!empty($validatedData['skills'])) {
                $skillsData = [];
                foreach ($validatedData['skills'] as $skill) {
                    $skillsData[$skill['id']] = ['proficiency_level' => $skill['proficiency_level']];
                }
                $candidateProfile->skills()->sync($skillsData);
            } else {
                $candidateProfile->skills()->detach();
            }
            

            if (!empty($validatedData['languages'])) {
                foreach ($validatedData['languages'] as $lang) {
                    if (!empty($lang['language_name'])) {
                        $user->candidateLanguages()->create([
                            'language_name' => $lang['language_name'],
                            'proficiency_level' => $lang['proficiency_level']
                        ]);
                    }
                }
            }

            if (!empty($validatedData['educations'])) {
                foreach ($validatedData['educations'] as $edu) {
                    if (!empty($edu['degree']) || !empty($edu['institution'])) {
                        $user->educations()->create([
                            'degree' => $edu['degree'] ?? null,
                            'institution' => $edu['institution'] ?? null,
                            'field_of_study' => $edu['field_of_study'] ?? null,
                            'from_date' => $edu['from_date'] ?? null,
                            'to_date' => $edu['to_date'] ?? null,
                        ]);
                    }
                }
            }

            if (!empty($validatedData['experiences'])) {
                foreach ($validatedData['experiences'] as $exp) {
                    if (!empty($exp['job_title']) || !empty($exp['company'])) {
                        $user->experiences()->create([
                            'job_title' => $exp['job_title'] ?? null,
                            'company' => $exp['company'] ?? null,
                            'from_date' => $exp['from_date'] ?? null,
                            'to_date' => $exp['to_date'] ?? null,
                            'description' => $exp['description'] ?? null,
                            'location' => $exp['location'] ?? null,
                            'ongoing' => isset($exp['ongoing']) ? true : false,
                            'job_type' => $exp['job_type'] ?? null,
                            'portfolio_url' => $exp['portfolio_url'] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json([
                'message' => 'Professional successfully saved!',
                'user' => $user
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again.'], 500);
        }
    }

    public function show($id)
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Professionals',
                'url' => route('professionalsList')
            ],
            [
                'label' => 'Professional Details',
                'url' => null
            ],
        ];

        try {
            $user = User::where('account_type', 4)
                ->with([
                    'candidateProfile.categories',
                    'candidateProfile.skills',
                    'candidateProfile.educations',
                    'candidateProfile.candidateLanguages',
                    'experiences',
                ])
                ->findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('professionals.index')->with('error', 'Professional not found.');
        }

        return view('admin.professionals.view', compact('breadcrumbs', 'user'));
    }

    public function editProfessional($id)
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Professional List',
                'url' => route('professionalsList')
            ],
            [
                'label' => "Edit Professional Details",
                'url' => null 
            ]
        ];

        $user = User::with([
            'candidateProfile',
            'candidateProfile.skills',
            'candidateProfile.categories',
            'candidateLanguages',
            'educations',
            'experiences'
        ])->findOrFail($id);

        $jobCategories = JobCategory::where('status', 'active')->get();
        $allSkills = Skill::where('status', 1)->get();

        $selectedCategories = $user->candidateProfile && $user->candidateProfile->categories
            ? $user->candidateProfile->categories->pluck('id')->toArray()
            : [];

        $selectedSkills = $user->skills ? $user->skills->pluck('id')->toArray() : [];

        return view('admin.professionals.edit', compact(
            'user',
            'jobCategories',
            'allSkills',
            'selectedCategories',
            'selectedSkills',
            'breadcrumbs'
        ));
    }

    
    public function updateProfessional(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $skills = collect($request->input('skills', []))
                        ->filter(fn($skill) => isset($skill['id']) && !empty($skill['id']) && !empty($skill['proficiency_level']))
                        ->toArray();
            $request->merge(['skills' => $skills]);
            
            $validator = Validator::make($request->all(), [
                'username' => 'string|max:255|unique:users,username,'.$id,
                'name' => 'string|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.$id,
                'phone' => 'nullable|string|max:20',
                'categories' => 'nullable|array',
                'gender' => 'nullable|in:Male,Female,Other',
                'profession' => 'nullable|string|max:255',
                'linkedin' => 'nullable|url',
                'github' => 'nullable|url',
                'website_url' => 'nullable|url',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
                'skills.*.id' => 'nullable|integer|exists:skills,id',
                'skills.*.proficiency_level' => 'nullable|in:beginner,intermediate,expert',
                'languages.*.language_name' => 'nullable|string|max:255',
                'languages.*.proficiency_level' => 'nullable|in:Basic,Fluent,Native',
                'educations.*.degree' => 'nullable|string|max:255',
                'educations.*.institution' => 'nullable|string|max:255',
                'educations.*.field_of_study' => 'nullable|string|max:255',
                'educations.*.from_date' => 'nullable|date',
                'educations.*.to_date' => 'nullable|date',
                'experiences.*.job_title' => 'nullable|string|max:255',
                'experiences.*.company' => 'nullable|string|max:255',
                'experiences.*.from_date' => 'nullable|date',
                'experiences.*.to_date' => 'nullable|date',
                'experiences.*.description' => 'nullable|string',
                'experiences.*.location' => 'nullable|string',
                'experiences.*.job_type' => 'nullable|string|max:255',
                'experiences.*.portfolio_url' => 'nullable|url|max:255',
                'experiences.*.ongoing' => 'nullable|in:0,1',
                'permanent_address' => 'nullable|string',
                'mailing_address' => 'nullable|string',
                'resume' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:5120',
                'permanent_city' => 'nullable|string|max:255',
                'permanent_state' => 'nullable|string|max:255',
                'permanent_country' => 'nullable|string|max:255',
                'mailing_city' => 'nullable|string|max:255',
                'mailing_state' => 'nullable|string|max:255',
                'mailing_country' => 'nullable|string|max:255',
                'about' => 'nullable|string',
                'salary' => 'nullable|string|max:255',
                'dob' => 'nullable|date',
            ], [
                'username.string' => 'Username must be a valid string.',
                'username.max' => 'Username cannot exceed 255 characters.',
                'username.unique' => 'This username is already taken.',
                
                'name.string' => 'Name must be a valid string.',
                'name.max' => 'Name cannot exceed 255 characters.',
                
                'email.required' => 'Email address is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.max' => 'Email address cannot exceed 255 characters.',
                'email.unique' => 'This email address is already registered.',
                
                'phone.string' => 'Phone number must be a valid string.',
                'phone.max' => 'Phone number cannot exceed 20 characters.',
                
                'categories.array' => 'Categories must be an array.',
                'categories.*.integer' => 'Each category ID must be a valid integer.',
                
                'gender.in' => 'Gender must be one of the following: Male, Female, or Other.',
                
                'profession.string' => 'Profession must be a valid string.',
                'profession.max' => 'Profession cannot exceed 255 characters.',
                
                'linkedin.url' => 'Please provide a valid LinkedIn URL.',
                'github.url' => 'Please provide a valid GitHub URL.',
                'website_url.url' => 'Please provide a valid website URL.',
                
                'profile_image.image' => 'Profile image must be an image file.',
                'profile_image.mimes' => 'Profile image must be one of the following types: jpeg, png, jpg, gif, svg, or webp.',
                'profile_image.max' => 'Profile image size cannot exceed 5MB.',
                
                'skills.*.id.integer' => 'Skill ID must be a valid integer.',
                'skills.*.id.exists' => 'The selected skill does not exist.',
                'skills.*.proficiency_level.in' => 'Proficiency level must be one of the following: beginner, intermediate, or expert.',
                
                'languages.*.language_name.string' => 'Language name must be a valid string.',
                'languages.*.language_name.max' => 'Language name cannot exceed 255 characters.',
                'languages.*.proficiency_level.in' => 'Proficiency level must be one of the following: Basic, Fluent, or Native.',
                
                'educations.*.degree.string' => 'Degree must be a valid string.',
                'educations.*.degree.max' => 'Degree cannot exceed 255 characters.',
                
                'educations.*.institution.string' => 'Institution must be a valid string.',
                'educations.*.institution.max' => 'Institution name cannot exceed 255 characters.',
                
                'educations.*.field_of_study.string' => 'Field of study must be a valid string.',
                'educations.*.field_of_study.max' => 'Field of study cannot exceed 255 characters.',
                
                'educations.*.from_date.date' => 'From date must be a valid date.',
                'educations.*.to_date.date' => 'To date must be a valid date.',
                
                'experiences.*.job_title.string' => 'Job title must be a valid string.',
                'experiences.*.job_title.max' => 'Job title cannot exceed 255 characters.',
                
                'experiences.*.company.string' => 'Company name must be a valid string.',
                'experiences.*.company.max' => 'Company name cannot exceed 255 characters.',
                
                'experiences.*.from_date.date' => 'From date must be a valid date.',
                'experiences.*.to_date.date' => 'To date must be a valid date.',
                
                'experiences.*.description.string' => 'Description must be a valid string.',
                
                'experiences.*.location.string' => 'Location must be a valid string.',
                
                'experiences.*.job_type.string' => 'Job type must be a valid string.',
                'experiences.*.job_type.max' => 'Job type cannot exceed 255 characters.',
                
                'experiences.*.portfolio_url.url' => 'Portfolio URL must be a valid URL.',
                'experiences.*.portfolio_url.max' => 'Portfolio URL cannot exceed 255 characters.',
                
                'experiences.*.ongoing.in' => 'Ongoing field must be either 0 (No) or 1 (Yes).',
                
                'permanent_address.string' => 'Permanent address must be a valid string.',
                
                'mailing_address.string' => 'Mailing address must be a valid string.',
                
                'resume.file' => 'Resume must be a valid file.',
                'resume.mimes' => 'Resume must be a file of type: pdf, jpeg, png, jpg.',
                'resume.max' => 'Resume size cannot exceed 5MB.',
                
                'permanent_city.string' => 'Permanent city must be a valid string.',
                'permanent_state.string' => 'Permanent state must be a valid string.',
                'permanent_country.string' => 'Permanent country must be a valid string.',
                
                'mailing_city.string' => 'Mailing city must be a valid string.',
                'mailing_state.string' => 'Mailing state must be a valid string.',
                'mailing_country.string' => 'Mailing country must be a valid string.',
                
                'about.string' => 'About section must be a valid string.',
                
                'salary.string' => 'Salary must be a valid string.',
                'salary.max' => 'Salary cannot exceed 255 characters.',
                
                'dob.date' => 'Date of birth must be a valid date.',
            ]);
            
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }
            
            
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }
            
            $validatedData = $validator->validated();

            $user = User::with('candidateProfile')->findOrFail($id);

            $user->update([
                'username' => $validatedData['username'],
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'] ?? null,
                'address' => $validatedData['permanent_address'] ?? null,
                'permanent_city' => $validatedData['permanent_city'] ?? null,
                'permanent_state' => $validatedData['permanent_state'] ?? null,
                'permanent_country' => $validatedData['permanent_country'] ?? null,
            ]);

            if ($request->hasFile('profile_image')) {
                if ($user->image && Storage::disk('public')->exists($user->image)) {
                    Storage::disk('public')->delete($user->image);
                }
                $file = $request->file('profile_image');
                $filename = $file->hashName();
                $file->storeAs('profile_images', $filename, 'public');
                $user->image = 'profile_images/' . $filename;
                $user->save();

                $thumbnailPath = 'profile_images/thumb/' . $filename;
                $thumbnailImage = Image::make($file->getRealPath())->resize(200, 200, function ($c) {
                    $c->aspectRatio();
                });
                Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
            }

            $purifier = new HTMLPurifier();
            
            $candidateProfileData = [
                'profession' => $validatedData['profession'] ?? null,
                'about' => isset($validatedData['about']) ? $purifier->purify($validatedData['about']) : null,
                'address' => $validatedData['mailing_address'] ?? null,
                'dob' => $validatedData['dob'] ?? null,
                'gender' => $validatedData['gender'] ?? null,
                'salary' => $validatedData['salary'] ?? null,
                'city' => $validatedData['mailing_city'] ?? null,
                'state' => $validatedData['mailing_state'] ?? null,
                'country' => $validatedData['mailing_country'] ?? null,
                'linkedin_url' => $validatedData['linkedin'] ?? null,
                'github_url' => $validatedData['github'] ?? null,
                'website_url' => $validatedData['website_url'] ?? null,
            ];
            $candidateProfile = $user->candidateProfile;
            $candidateProfile->update($candidateProfileData);

            if ($request->has('categories') && is_array($request->categories)) {
                $candidateProfile->categories()->sync($request->categories);
            } else {
                $candidateProfile->categories()->sync([]);
            }

            if ($request->hasFile('resume')) {
                if ($candidateProfile->resume && Storage::disk('public')->exists($candidateProfile->resume)) {
                    Storage::disk('public')->delete($candidateProfile->resume);
                }
                $resumePath = $request->file('resume')->store('candidates', 'public');
                $candidateProfile->update(['resume' => $resumePath]);
            }

            $skillsData = [];
            if (!empty($validatedData['skills'])) {
                foreach ($validatedData['skills'] as $skill) {
                    if (!empty($skill['id']) && !empty($skill['proficiency_level'])) {
                        $skillsData[$skill['id']] = ['proficiency_level' => $skill['proficiency_level']];
                    }
                }
                $user->candidateProfile->skills()->sync($skillsData);
            } else {
                $user->candidateProfile->skills()->detach();
            }

            
            $ids = [];
        if (!empty($validatedData['languages'])) {
            foreach ($validatedData['languages'] as $lang) {
                if (!empty($lang['language_name'])) {
                    
                    $existing = $user->candidateLanguages()
                        ->where('language_name', $lang['language_name'])
                        ->first();

                    if ($existing) {
                        $existing->update(['proficiency_level' => $lang['proficiency_level']]);
                        $ids[] = $existing->id;
                    } else {
                        $new = $user->candidateLanguages()->create([
                            'language_name' => $lang['language_name'],
                            'proficiency_level' => $lang['proficiency_level']
                        ]);
                        $ids[] = $new->id;
                    }
                }
            }
            $user->candidateLanguages()->whereNotIn('id', $ids)->delete();
        } else {
            $user->candidateLanguages()->delete();
        }


            

            $exp_ids = [];
            if (!empty($validatedData['experiences'])) {
                
                foreach ($validatedData['experiences'] as $exp) {
                    
                    if (!empty($exp['job_title']) || !empty($exp['company'])) {
                        $existing = $user->experiences()
                            ->where('job_title', $exp['job_title'])
                            ->where('company', $exp['company'])
                            ->first();

                            $isOngoing = !empty($exp['ongoing']) ? 1 : 0;
                        if ($existing) {
                            $existing->update([
                                'from_date'      => $exp['from_date']      ?? null,
                                'to_date'        => $exp['to_date']        ?? null,
                                'description'    => $exp['description']    ?? null,
                                'location'       => $exp['location']       ?? null,
                                'ongoing'        => $isOngoing,
                                'job_type'       => $exp['job_type']       ?? null,
                                'portfolio_url'  => $exp['portfolio_url']  ?? null,
                            ]);
                            $exp_ids[] = $existing->id;
                        } else {
                            $new = $user->experiences()->create([
                                'job_title'      => $exp['job_title']      ?? null,
                                'company'        => $exp['company']        ?? null,
                                'from_date'      => $exp['from_date']      ?? null,
                                'to_date'        => $exp['to_date']        ?? null,
                                'description'    => $exp['description']    ?? null,
                                'location'       => $exp['location']       ?? null,
                                'ongoing'        => $isOngoing,
                                'job_type'       => $exp['job_type']       ?? null,
                                'portfolio_url'  => $exp['portfolio_url']  ?? null,
                            ]);
                            $exp_ids[] = $new->id;
                        }
                    }
                }
                $user->experiences()->whereNotIn('id', $exp_ids)->delete();
            } else {
                $user->experiences()->delete();
            }


            DB::commit();
            return response()->json([
                'message' => 'Professional data updated successfully!',
                'user' => $user
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again.'], 500);
        }
    }



    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::with([
                'candidateProfile.categories',
                'candidateProfile',
                'candidateProfile.skills', 
                'candidateLanguages',
                'educations',
                'experiences',
            ])->findOrFail($id);

            if ($user->account_type != 4) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            $thumb = str_replace('profile_images/', 'profile_images/thumb/', $user->image);
            if ($user->image && Storage::disk('public')->exists($thumb)) {
                Storage::disk('public')->delete($thumb);
            }

            $candidateProfile = $user->candidateProfile;
            if ($candidateProfile) {
                $candidateProfile->categories()->detach();

                if (method_exists($candidateProfile, 'skills')) {
                    $candidateProfile->skills()->detach();
                }

                if ($candidateProfile->resume && Storage::disk('public')->exists($candidateProfile->resume)) {
                    Storage::disk('public')->delete($candidateProfile->resume);
                }

                $candidateProfile->delete();
            }

            if (method_exists($user, 'skills')) {
                $user->skills()->detach();
            }

            $user->candidateLanguages()->delete();
            $user->educations()->delete();
            $user->experiences()->delete();

            $user->delete();

            DB::commit();
            return response()->json(['success' => 'Professional deleted successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again.'], 500);
        }
    }




}