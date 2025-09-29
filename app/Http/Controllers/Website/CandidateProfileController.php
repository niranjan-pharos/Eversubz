<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\CandidateLanguage;
use App\Models\CandidateProfile;
use App\Models\JobCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;


class CandidateProfileController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', config('constants.DEFAULT_PAGINATION'));

        $isAuthenticated = Auth::check();
        $isVerified = $isAuthenticated ? Auth::user()->hasVerifiedEmail() : false;
        $is_module_visible = $isAuthenticated ? (Auth::user()->is_module_visible == 1) : false;

        if ($isAuthenticated && !$is_module_visible) {
            return redirect()->route('user.pending-approval');
        }

        if ($isAuthenticated && $isVerified && $is_module_visible) {
            $candidates = User::where('account_type', 4)
                ->where('status', 'active')
                ->with([
                    'candidateProfile.skills',
                    'candidateProfile.educations',
                    'candidateProfile.candidateLanguages',
                    'candidateProfile.categories',
                    'experiences',
                ])
                
                ->paginate($perPage);
        } else {
            $candidates = collect(); 
        }

        
        $categories  = JobCategory::where('status', 'active')->get();
        $locations   = CandidateProfile::whereNotNull('city')->distinct()->pluck('city');
        $skills      = Skill::where('status', 1)->distinct()->pluck('skill_name');
        $experiences = User::where('account_type', 4)
            ->where('status', 'active')
            ->join('candidate_experiences', 'users.id', '=', 'candidate_experiences.user_id')
            ->selectRaw('FLOOR(SUM(TIMESTAMPDIFF(MONTH, from_date, IF(ongoing = 1, CURDATE(), to_date))) / 12) as total_experience_years')
            ->groupBy('users.id')
            ->pluck('total_experience_years')
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        return view('website.candidates.candidate-listing', compact(
            'candidates',
            'categories',
            'locations',
            'skills',
            'experiences',
            'isAuthenticated',
            'isVerified',
        ));
    }




    public function details($encryptedId)
    {
        $candidateId = Crypt::decrypt($encryptedId);
        $candidate = User::where('id', $candidateId)
            ->where('account_type', 4)
            ->with([
                'candidateProfile.skills',
                'educations', 
                'experiences',
                'candidateProfile.candidateLanguages',
            ])
            ->firstOrFail();

        if (!$candidate) {
            return redirect()->route('home')->with('error', 'Candidate not found.');
        }

        $isAuthenticated = Auth::check();
        $isVerified = $isAuthenticated ? Auth::user()->hasVerifiedEmail() : false;
        $is_module_visible = $isAuthenticated ? (Auth::user()->is_module_visible == 1) : false;

        if ($isAuthenticated && !$is_module_visible) {
            return redirect()->route('user.pending-approval');
        }


        return view('website.candidates.candidate-details', compact('candidate'));
    }



    public function downloadResume($id)
    {
        try {
            $candidateProfile = CandidateProfile::where('user_id', $id)->first();

            if (!$candidateProfile) {
                return redirect()->back()->with('error', 'Candidate Profile not found.');
            }

            if (!$candidateProfile->resume) {
                return redirect()->back()->with('error', 'Resume not found.');
            }

            $filePath = public_path('storage/' . $candidateProfile->resume);

            
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File does not exist.');
            }

            return response()->download($filePath);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred while downloading the resume.');
        }
    }


    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'to_email' => 'required|email|max:255', 
            'email' => 'required|email|max:255', 
            'message' => 'required|string|min:5|max:1000',
        ]);

        // Handle validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $toEmail = $request->to_email; 
            $details = [
                'name' => htmlspecialchars($request->name),
                'email' => htmlspecialchars($request->email),
                'message' => nl2br(htmlspecialchars($request->message))
            ];

            Mail::raw("You have received a new message.\n\n"
                . "Name: {$details['name']}\n"
                . "Email: {$details['email']}\n"
                . "Message:\n{$details['message']}", function ($mail) use ($toEmail) {
                $mail->to($toEmail)
                    ->subject('New Contact Form Message');
            });

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully!'
            ]);
        } catch (\Exception $e) {
            // Handle errors when sending email
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again later.',
                'error' => $e->getMessage() 
            ], 500);
        }
    }


}