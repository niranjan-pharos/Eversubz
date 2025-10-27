<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminMessage;
use Auth;
use App\Models\Admin;
use App\Models\AdPost;
use App\Models\UserBusinessInfos;
use App\Models\BusinessProduct;
use App\Models\Event;
use App\Models\Ngo;
use App\Models\Job;
use App\Models\User;

use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Log;
 
class AdminController extends Controller
{
    public function login(){
        return view('admin.adminLogin');
    }

    public function dashboard()
    {
        // Breadcrumbs for the dashboard
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => null
            ],
        ];
        $totalUsersCount = User::count('id');

        // Retrieve counts of active and inactive AdPosts
        $adsactiveAdPostsCount = AdPost::where('status', 1)->count();
        $adsinactiveAdPostsCount = AdPost::where('status', 0)->count();
        $adstotalCount = $adsactiveAdPostsCount + $adsinactiveAdPostsCount;

        $businessactiveAdPostsCount = UserBusinessInfos::where('status', 1)->count();
        $businessinactiveAdPostsCount = UserBusinessInfos::where('status', 0)->count();
        $businesstotalCount = $businessactiveAdPostsCount + $businessinactiveAdPostsCount;

        $productsactiveAdPostsCount = BusinessProduct::where('status', 1)->count();
        $productsinactiveAdPostsCount = BusinessProduct::where('status', 0)->count();
        $productstotalCount = $productsactiveAdPostsCount + $productsinactiveAdPostsCount;

        $eventsactiveAdPostsCount = Event::where('status', 1)->count();
        $eventsinactiveAdPostsCount = Event::where('status', 0)->count();
        $eventstotalCount = $eventsactiveAdPostsCount + $eventsinactiveAdPostsCount;

        $ngosactiveAdPostsCount = Ngo::where('status', 1)->count();
        $ngosinactiveAdPostsCount = Ngo::where('status', 0)->count();
        $ngostotalCount = $ngosactiveAdPostsCount + $ngosinactiveAdPostsCount;

        $jobsactiveAdPostsCount = Job::where('status', 'active')->count();
        $jobsinactiveAdPostsCount = Job::where('status', 'inactive')->count();
        $jobstotalCount = $jobsactiveAdPostsCount + $jobsinactiveAdPostsCount;

        // Pass the data to the view
        return view('admin.adminDashboard', compact('breadcrumbs', 'totalUsersCount', 'adstotalCount', 'adsactiveAdPostsCount', 'adsinactiveAdPostsCount', 'businesstotalCount', 'businessactiveAdPostsCount', 'businessinactiveAdPostsCount', 'productstotalCount', 'productsactiveAdPostsCount', 'productsinactiveAdPostsCount', 'eventstotalCount', 'eventsactiveAdPostsCount', 'eventsinactiveAdPostsCount', 'jobstotalCount', 'jobsactiveAdPostsCount', 'jobsinactiveAdPostsCount', 'ngostotalCount', 'ngosactiveAdPostsCount', 'ngosinactiveAdPostsCount'));
    }
    
    
    // public function login_submit(Request $request){
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);
    
    //     $credentials = $request->only('email','password');
    //     if(Auth::guard('admin')->attempt($credentials)){
    //         $user = Admin::where('email', $request->input('email'))->first();
    //     Auth::guard('admin')->login($user);
    //         return redirect()->route('adminDashboard')->with('success','Login Successful');
    //     }else{
    //         return redirect()->route('adminLogin')->with('error','Login unsuccessful');
    //     }    
    // }

    public function login_submit(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|string|min:6',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('adminDashboard'))->with('success', 'Login Successful');
        } else {
            Log::warning('Admin login failed for email: ' . $request->email, ['credentials' => $credentials]);
            return redirect()->route('adminLogin')->with('error', 'Login unsuccessful');
        }
    }
    

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
    
    public function announcement(){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Announcement',
                'url' => null
            ],
        ];
        return view('admin.listAnnouncement',compact('breadcrumbs'));
    }

    public function fetchTableData(){

        $announcements = AdminMessage::select('id', 'heading','description', 'orderby','status','created_at','updated_at')->orderBy('id','DESC')->get();

        foreach ($announcements as $key => $announcement) {
            $buttons = ''; $status  =''; $icon= '';

           

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $announcement->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';

            if($announcement->status == 1) {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$announcement->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            }else{
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$announcement->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }


            $result['data'][$key] = [
                $announcement->heading,
                $announcement->description,
                $announcement->orderby,
                $status,
                optional($announcement->created_at)->format('d-m-Y'),
                optional($announcement->updated_at)->format('d-m-Y'),
                $buttons,
            ];
        }

        return response()->json($result);
    }

    public function message(){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Announcement List',
                'url' => route('adminAnnouncement')
            ],
            [
                'label' => 'Add Announcement',
                'url' => null
            ],
        ];
        return view('admin.adminMessage',compact('breadcrumbs'));
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'orderby' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $adminMessage = new AdminMessage();
        $adminMessage->heading = $request->input('heading');
        $adminMessage->description = $request->input('description');
        $adminMessage->orderby = $request->input('orderby');
        $adminMessage->status = $request->input('status');
        $adminMessage->save();

        return response()->json(['message' => 'Message created successfully']);
    }

    public function destroyAnnouncement($id)
    {
        try {
            $announcement = AdminMessage::where('id', $id)->first();

            if (!$announcement) {
                return response()->json(['error' => 'Announcement not found'], 404);
            }

            $announcement->delete();

            return response()->json(['success' => true, 'message' => 'Announcement deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error deleting announcement: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while trying to delete the announcement'], 500);
        }
    }
}
