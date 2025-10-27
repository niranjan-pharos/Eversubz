<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundraisingCategory;
use Illuminate\Support\Facades\Validator;
use Str;
use Illuminate\Support\Facades\Auth;


class FundraisingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('adminDashboard')],
            ['label' => 'Fundraising Category', 'url' => null],
        ];
        return view('admin.fundraisingcategory.index', compact('breadcrumbs'));
    }

    public function create()
    {
        //
    }

    public function fetchTableData(){
        $result = ['data' => []];

        $categories = FundraisingCategory::select('id', 'name', 'slug','status','created_at','updated_at')->orderby('id','desc')->get();

        foreach ($categories as $key => $category) {
            $buttons = ''; $status  ='';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="editFunc(' . $category->id . ')" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i></button>';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $category->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';


            if($category->status == 1) {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$category->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            }else{
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$category->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }


            $result['data'][$key] = [
                $category->name,
                $category->slug,
                $status,
                optional($category->created_at)->format('d-m-Y'),
                optional($category->updated_at)->format('d-m-Y'),
                $buttons,
            ];
        }

        return response()->json($result);
    }

    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
          
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        // Store fundraising data
        try {
            $fundraising = new FundraisingCategory();
            $fundraising->name = $request->name;
            $fundraising->slug = Str::slug($request->name);
            $fundraising->status = $request->status;
            $fundraising->save();

            return response()->json(['status' => true, 'messages' => 'Event category created successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Error saving fundraising: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again.'], 500);
        }
    }


   
    public function changeStatus(Request $request){
        $post = FundraisingCategory::findOrFail($request->id);
        $post->status = $request->status == 'true' ? 1 : 0;
        $post->save();
    
        return response()->json(['message' => 'Status changed']);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   
     public function edit(Request $request){
        $cat_id = $request->id;
        
        $category = FundraisingCategory::findOrFail($cat_id);
    
    
        return response()->json(['id'=>$cat_id, 'name'=>$category->name,'status' => $category->status]);
    }
    


    public function update(Request $request)
    {
        $id = $request->cat_id;

        $eventInfo = FundraisingCategory::find($id);

        if (!$eventInfo) {
            return response()->json(['error' => 'Event category not found.'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        $newSlug = Str::slug($request->name);

        $duplicateSlug = FundraisingCategory::where('slug', $newSlug)->where('id', '!=', $id)->first();

        if ($duplicateSlug) {
            return response()->json(['error' => 'Duplicate slug found. Please use a different name.'], 422);
        }

        $eventInfo->name = $validated['name'];
        $eventInfo->slug = $newSlug;
        $eventInfo->status = $validated['status'];

        if ($eventInfo->save()) {
            return response()->json(['success'=>true, 'messages' => 'Event category updated successfully.']);
        } else {
            return response()->json(['error' => 'Failed to update event category. Please try again.'], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            if (!Auth::guard('admin')->check()) {
                return response()->json(['error' => 'You are not authorized to delete this category'], 403);
            }
    
            $del_id = $request->del_id;
    
            $event = FundraisingCategory::findOrFail($del_id);
    
            // Delete event
            $event->delete();
    
            return response()->json(['success' => true, 'messages' => 'Event category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'messages' => "Error deleting Event"]);
        }
    }
}
