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
    
            $posts = AdPost::select(
                'ad_posts.id',
                'ad_posts.user_id',
                'ad_posts.post_id',
                'ad_posts.title',
                'ad_posts.status',
                'categories.name as category_name',
                'user_business_infos.business_name as business_name', // ✅ Joined Business Name
                'ad_posts.price',
                'ad_posts.product_condition',
                'ad_posts.featured',
                'ad_posts.recommended',
                'ad_posts.urgent',
                'ad_posts.spotlight',
                'ad_posts.expiry_date',
                'ad_posts.created_at',
                'ad_posts.updated_at'
            )
            ->leftJoin('categories', 'ad_posts.category_id', '=', 'categories.id')
            ->leftJoin('user_business_infos', 'user_business_infos.user_id', '=', 'ad_posts.user_id')
            ->orderBy('ad_posts.created_at', 'desc')
            ->get();

        foreach ($posts as $key => $post) {
            $buttons = ''; 

            $title = htmlspecialchars(addslashes($post->title), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); 
            $businessName = htmlspecialchars(addslashes($post->business_name ?? '-'), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); // ✅ direct from join

            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" 
                onclick="downloadLabel(' 
                . $post->post_id . ', \'' . $title . '\', \'' . $businessName . '\')">
                <i class="fa fa-print"></i>
            </button>';
    
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

            $price = $post->price;
            $priceHtml = $price <= 0 
                ? '<span class="price-negative">' . $price . '</span>'
                : '<span class="price-positive">' . $price . '</span>'; 

                $categoryColors = [
                    'Weddings' => ['light' => '#cfe2ff', 'dark' => '#007bff'],
                    'Home & Furnitures' => ['light' => '#d4edda', 'dark' => '#28a745'],
                    'Art & Education' => ['light' => '#fff3cd', 'dark' => '#ffc107'],
                    'Fashion' => ['light' => '#f8d7da', 'dark' => '#dc3545'],
                    'Bags & Accessories' => ['light' => '#d1ecf1', 'dark' => '#17a2b8'],
                    'Order Online' => ['light' => '#e2d9f9', 'dark' => '#6f42c1'],
                    'Services' => ['light' => '#ffe5d0', 'dark' => '#fd7e14'],
                    'Realstate' => ['light' => '#d1f7ec', 'dark' => '#20c997'],
                ];

                $categoryName = $post->category_name;
                $color = isset($categoryColors[$categoryName]) ? $categoryColors[$categoryName] : ['light' => '#e2e3e5', 'dark' => '#6c757d'];

                $categoryHtml = '<span class="category-badge" style="background-color:' . $color['light'] . '; color:' . $color['dark'] . ';">
                                    <span class="category-dot" style="background-color:' . $color['dark'] . ';"></span>
                                    ' . $categoryName . '
                                 </span>';

                $today = new DateTime(); // today

                $dateString = trim($formattedDate); // remove extra spaces
                $dateValue = DateTime::createFromFormat('d-m-Y', $dateString);

                if (!$dateValue) {
                    // fallback if parsing fails
                    $dateHtml = '<span>' . htmlspecialchars($dateString) . '</span>';
                } else {
                    // compare dates ignoring time
                    $todayStr = $today->format('Y-m-d');
                    $dateStr  = $dateValue->format('Y-m-d');

                    if ($dateStr == $todayStr) {
                        $dateHtml = '<span class="date-today">' . htmlspecialchars($dateString) . '</span>';
                    } elseif ($dateValue > $today) {
                        $dateHtml = '<span class="date-upcoming">' . htmlspecialchars($dateString) . '</span>';
                    } else {
                        $dateHtml = '<span class="date-expired">' . htmlspecialchars($dateString) . '</span>';
                    }
                }
          
            $result['data'][$key] = [
                $post->post_id,
                $post->title,
                $categoryHtml, // Category Name instead of Category ID
                $priceHtml,
                $dateHtml,
                $feature,
                $recommend,
                $urgent, 
                $spotlight,
                $status, 
                $post->product_condition,
                $post->created_at ? $post->created_at->format('d-m-Y') : '', // Safe formatting
                $post->updated_at ? $post->updated_at->format('d-m-Y') : '', // Safe formatting
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