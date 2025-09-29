<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Redirect, Storage, Session, Log, DB};
use App\Models\User;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\JobCategory;
use App\Models\CandidateLanguage;
use App\Models\CandidateProfile;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;



class CandidateInfoController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'account.type:4']);
    }


    public function index()
    {
        $candidateId = auth()->id();

        $user = User::where('id', $candidateId)
            ->where('account_type', 4)
            ->where('status', 'active')
            ->with([
                'candidateProfile.skills', 
                'candidateProfile.educations',
                'candidateProfile.candidateLanguages',
                'candidateProfile.categories',
            ])
            ->firstOrFail();

        $allSkills = Skill::all(); 
        $jobCategories = JobCategory::all();
        return view('frontend.candidate.profile', compact('user', 'allSkills', 'jobCategories'));
    }

    

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validate inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'salary' => 'nullable|string|max:10',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:2048', // Validation for resume file
            'permanent_address' => 'nullable|string|max:255',
            'permanent_city' => 'nullable|string|max:255',
            'permanent_state' => 'nullable|string|max:255',
            'permanent_country' => 'nullable|string|max:255',
            'mailing_address' => 'nullable|string|max:255',
            'mailing_city' => 'nullable|string|max:255',
            'mailing_state' => 'nullable|string|max:255',
            'mailing_country' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'profession' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'github' => 'nullable|string',
            'website_url' => 'nullable|string',
            'gender' => 'required|in:Male,Female,Other',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:job_categories,id',
            'educations.*.from_date' => 'nullable|date',
            'educations.*.to_date' => 'nullable|date|after_or_equal:educations.*.from_date',
            'experiences.*.from_date' => 'nullable|date',
            'experiences.*.to_date' => 'nullable|date|after_or_equal:experiences.*.from_date',
        ], [
            'educations.*.to_date.after_or_equal' => 'The end date must be greater than or equal to the start date in education.',
            'experiences.*.to_date.after_or_equal' => 'The end date must be greater than or equal to the start date in experience.',
        ]);

        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->permanent_address,
            'permanent_city' => $request->permanent_city,
            'permanent_state' => $request->permanent_state,
            'permanent_country' => $request->permanent_country,
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            if ($user->image && \Storage::exists($user->image)) {
                \Storage::delete($user->image);
            }
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->update(['image' => $path]);
        }

        $candidateProfile = $user->candidateProfile;
        if (!$candidateProfile) {
            $candidateProfile = $user->candidateProfile()->create(['user_id' => $user->id]);
        }

        // Handle resume file upload
        if ($request->hasFile('resume')) {
            if ($candidateProfile->resume && \Storage::exists($candidateProfile->resume)) {
                \Storage::delete($candidateProfile->resume);
            }
            $resumePath = $request->file('resume')->store('candidates', 'public');
            $candidateProfile->update(['resume' => $resumePath]);
        }

        $candidateProfile->update([
            'address' => $request->mailing_address,
            'city' => $request->mailing_city,
            'state' => $request->mailing_state,
            'country' => $request->mailing_country,
            'about' => $request->about,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'salary' => $request->salary,
            'profession' => $request->profession,
            'linkedin_url' => $request->linkedin,
            'github_url' => $request->github,
            'website_url' => $request->website_url,
        ]);

        if ($request->has('categories')) {
            $candidateProfile->categories()->sync($request->categories);
        }

        // Update Skills
        if ($request->has('skills')) {
            $candidateProfile = $user->candidateProfile;
        
            if ($candidateProfile) {
                $skillsToSync = [];
                
                foreach ($request->skills as $skill) {
                    if (!empty($skill['id'])) {
                        // Prepare sync data
                        $skillsToSync[$skill['id']] = ['proficiency_level' => $skill['proficiency_level']];
                    }
                }
                
                $candidateProfile->skills()->sync($skillsToSync);
            }
        }
        
        // education
        if ($request->has('educations') && count($request->educations)) {
            $ids = [];
            foreach ($request->educations as $education) {
                if (empty($education['degree']) || empty($education['institution'])) {
                    continue;
                }
                $edu = $user->educations()->updateOrCreate(
                    [
                        'degree' => $education['degree'],
                        'institution' => $education['institution']
                    ],
                    [
                        'field_of_study' => $education['field_of_study'] ?? null,
                        'from_date' => $education['from_date'] ?? null,
                        'to_date' => isset($education['ongoing']) && $education['ongoing'] === 'on' ? null : $education['to_date'] ?? null,
                        'ongoing' => isset($education['ongoing']) && $education['ongoing'] === 'on' ? 1 : 0,
                        'grade' => $education['grade'] ?? null,
                        'location' => $education['location'] ?? null,
                        'achievements' => $education['achievements'] ?? null,
                        'description' => $education['description'] ?? null,
                        'certificate_url' => $education['certificate_url'] ?? null
                    ]
                );
                $ids[] = $edu->id;
            }
            $user->educations()->whereNotIn('id', $ids)->delete();
        } else {
            $user->educations()->delete();
        }
        
        
        // experience
        if ($request->has('experiences') && count($request->experiences)) {
            $user->experiences()->delete();
            foreach ($request->experiences as $experience) {
                if (empty($experience['job_title']) || empty($experience['company'])) {
                    continue;
                }
                $user->experiences()->create([
                    'job_title' => $experience['job_title'],
                    'company' => $experience['company'],
                    'from_date' => $experience['from_date'] ?? null,
                    'to_date' => ($experience['ongoing'] ?? 0) == 1 ? null : ($experience['to_date'] ?? null),
                    'ongoing' => ($experience['ongoing'] ?? 0) == 1 ? 1 : 0,
                    'description' => $experience['description'] ?? null,
                    'location' => $experience['location'] ?? null,
                    'job_type' => $experience['job_type'] ?? null,
                    'portfolio_url' => $experience['portfolio_url'] ?? null,
                ]);
            }
        } else {
            $user->experiences()->delete();
        }
        

        // Language
        if ($request->has('languages') && count($request->languages)) {
            $ids = [];
            foreach ($request->languages as $lang) {
                if (empty($lang['language_name'])) continue; 
        
                $existing = $user->candidateLanguages()
                    ->where('language_name', $lang['language_name'])
                    ->first();
        
                if ($existing) {
                    $existing->update([
                        'proficiency_level' => $lang['proficiency_level']
                    ]);
                    $ids[] = $existing->id;
                } else {
                    $new = $user->candidateLanguages()->create([
                        'language_name' => $lang['language_name'],
                        'proficiency_level' => $lang['proficiency_level']
                    ]);
                    $ids[] = $new->id;
                }
            }
            $user->candidateLanguages()->whereNotIn('id', $ids)->delete();
        } else {
            $user->candidateLanguages()->delete();
        }
        
        
        

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }



    public function deleteImage(ProductImage $product, Request $request)
    {       
        try {
            Storage::disk('public')->delete($product->image_path);
            $product->delete();

            return response()->json(['success' => 'Image removed successfully.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while removing the image.'], 500);
        }
    }


    
    public function destroy($item_url)
    {
        $product = BusinessProduct::with(['UserBusinessInfos' => function ($query) {
            $query->select('id', 'user_id');
        },
        'images' => function ($query) {
            $query->select('business_product_id', 'image_path'); 
        }])->where('item_url', $item_url)->firstOrFail();
        

        if ($product->UserBusinessInfos->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }        

        if ($product->main_image) {
            Storage::disk('public')->delete($product->main_image);
        }

        if ($product->Images) {
            foreach ($product->Images as $image) {
                if ($image->image_path) {
                    Storage::disk('public')->delete($image->image_path);
                }
            }
        }

        $product->delete();

        return response()->json(['success' => 'Product deleted successfully!']);
    }


    public function toggleBookmark(Request $request, $userId)
    {
        try {
            // Check if the authenticated user exists
            $authUserId = Auth::id();
            if (!$authUserId) {
                // Explicitly return 401 unauthorized response with appropriate message
                return response()->json(['success' => false, 'message' => 'You must be logged in for bookmark.'], 401);
            }

            $candidateProfile = CandidateProfile::where('user_id', $userId)->first();

            if (!$candidateProfile) {
                return response()->json(['success' => false, 'message' => 'Candidate profile not found.'], 404);
            }

            // Use the correct candidate_profile_id
            $candidateProfileId = $candidateProfile->id;

            // Check if the bookmark already exists
            $bookmarkExists = DB::table('candidate_bookmarks')
                ->where('user_id', $authUserId)
                ->where('candidate_profile_id', $candidateProfileId)
                ->exists();

            if ($bookmarkExists) {
                // Remove the bookmark if it already exists
                DB::table('candidate_bookmarks')
                    ->where('user_id', $authUserId)
                    ->where('candidate_profile_id', $candidateProfileId)
                    ->delete();

                return response()->json([
                    'success' => true,
                    'bookmarked' => false,
                    'message' => 'Bookmark removed successfully.'
                ]);
            } else {
                // Add the bookmark with the correct candidate_profile_id
                DB::table('candidate_bookmarks')->insert([
                    'user_id' => $authUserId,
                    'candidate_profile_id' => $candidateProfileId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return response()->json([
                    'success' => true,
                    'bookmarked' => true,
                    'message' => 'Bookmark added successfully.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while toggling the bookmark.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    


}
