<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdPost;
use App\Models\Tag;
use App\Models\PostImage;
use App\Models\Review;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\DB; 
use DateTime;
use Illuminate\Support\Facades\Log;
 
class AdPostController extends Controller
{ 
    public function index(){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'AdPost',
                'url' => null
            ],
        ];
        return view('admin.adpost.index',compact('breadcrumbs'));
    }
 
    public function fetchTableData(){
        $result = ['data' => []];
    
        $posts = AdPost::select('ad_posts.id','ad_posts.post_id', 'ad_posts.title', 'ad_posts.status', 'categories.name as category_name', 'ad_posts.price', 'ad_posts.product_condition','ad_posts.featured','ad_posts.recommended','ad_posts.urgent','ad_posts.spotlight', 'ad_posts.expiry_date')
                    ->leftJoin('categories', 'ad_posts.category_id', '=', 'categories.id')
                    ->orderBy('ad_posts.id', 'desc') // Order by 'created_at' in descending order
                    ->get();
    
        foreach ($posts as $key => $post) {
            $buttons = ''; 
    
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="viewFunc(' . $post->id . ')"><i class="fa fa-eye"></i></button>';
    
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="removeFunc(' . $post->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';
    
            if($post->status == 1) {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            } else { 
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }
            if($post->featured == 1) {
                $feature = '<div class="form-check form-switch">
                <input class="form-check-input change-feature" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            } else { 
                $feature = '<div class="form-check form-switch">
                <input class="form-check-input change-feature" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }
            if($post->recommended == 1) {
                $recommend = '<div class="form-check form-switch">
                <input class="form-check-input change-recommend" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexRecommendCheckChecked" checked></div>';
            } else { 
                $recommend = '<div class="form-check form-switch">
                <input class="form-check-input change-recommend" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexRecommendCheckChecked" ></div>';
            } 
            if($post->urgent == 1) {
                $urgent = '<div class="form-check form-switch">
                <input class="form-check-input change-urgent" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexUrgentCheckChecked" checked></div>';
            } else { 
                $urgent = '<div class="form-check form-switch">
                <input class="form-check-input change-urgent" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexUrgentCheckChecked" ></div>';
            }
            if($post->spotlight == 1) {
                $spotlight = '<div class="form-check form-switch">
                <input class="form-check-input change-spotlight" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSpotlightCheckChecked" checked></div>';
            } else { 
                $spotlight = '<div class="form-check form-switch">
                <input class="form-check-input change-spotlight" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSpotlightCheckChecked" ></div>';
            }
            $dateTime = new DateTime($post->expiry_date);
            $formattedDate = $dateTime->format('d-m-Y');
            $result['data'][$key] = [
                $post->post_id,
                $post->title,
                $post->category_name, // Category Name instead of Category ID
                $post->price,
                $formattedDate,
                $feature,
                $recommend,
                $urgent, 
                $spotlight,
                $status, 
                $post->product_condition,
                $buttons,
            ];
        }
    
        return response()->json($result);
    }
    

    public function viewPost($id)
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'AdPost List',
                'url' => route('adPost.listing')
            ],
            [
                'label' => 'AdPost View',
                'url' => null
            ],
        ];

        

        $adPost = AdPost::with(['user','tags:id,tag_name,ad_post_id', 'images:id,url,ad_post_id','category','subcategory'])->find($id);
       
                
        if (!$adPost) {
            abort(404);
        }

        $reviews = Review::where('reviewable_type', AdPost::class)
                        ->where('reviewable_id', $adPost->id)
                        ->get();

        $reports = Report::where('ad_post_id', $adPost->id)->get();
        $reviewCountForPost = $reviews->count();

        return view('admin.adpost.view', compact('adPost', 'reviews', 'reports', 'reviewCountForPost', 'breadcrumbs'));
    }


    public function destroy(Request $request)
    {
        try {
            $postId = $request->input('del_id');
            $post = AdPost::find($postId);

            if (!$post) {
                return response()->json(['error' => false, 'messages' => 'Ad Post not found']);
            }

            // Delete associated tags
            $post->tags()->delete();

            // Delete associated images
            $post->images()->delete();

            // Now delete the AdPost
            $post->delete();

            return response()->json(['success' => true, 'messages' => 'Ad Post deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => false, 'messages' => "Error deleting Ad Post"]);
        }
    }


    // change status 
    function changeStatus(Request $request){
        
        $post = AdPost::findOrFail($request->id);
        
        $post->status = $request->status == 'true' ? 1 : 0;
        $post->save();

        return response(['message' => 'Status changed']);
    }

    function changeFeature(Request $request){
        $post = AdPost::findOrFail($request->id);
        $post->featured = $request->feature == 'true' ? 1 : 0;
        $post->save();
        return response(['message' => 'Feature status changed']);
    }
    function changeRecommend(Request $request){

        $post = AdPost::findOrFail($request->id);
        $post->recommended = $request->recommend == 'true' ? 1 : 0;
        $post->save();

        return response(['message' => 'Recommend status changed']);
    }
    function changeUrgent(Request $request){

        $post = AdPost::findOrFail($request->id);
        $post->urgent = $request->urgent == 'true' ? 1 : 0;
        $post->save();

        return response(['message' => 'Urgent status changed']);
    }
    function changeSpotlight(Request $request){

        $post = AdPost::findOrFail($request->id);
        $post->spotlight = $request->spotlight == 'true' ? 1 : 0;
        $post->save();

        return response(['message' => 'Spotlight status changed']);
    }

   

    public function changeReviewStatus(Request $request)
    {
        try {
            $review = Review::findOrFail($request->id); // Find the review by its ID
            $review->status = $request->status; // Set the status from the request
            $review->save(); // Save the changes to the database
            
            return response()->json(['message' => 'Review status changed successfully']);
        } catch (\Exception $e) {
            // Handle any errors that occur
            return response()->json(['error' => true, 'message' => 'Error changing review status']);
        }
    }


}