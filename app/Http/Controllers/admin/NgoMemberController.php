<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ngo;
use App\Models\NgoMember;
use Illuminate\Http\Request;

class NgoMemberController extends Controller
{
    public function index($id)
    {
        $ngoInfo = Ngo::select('ngo_name')->find($id);
        if ($ngoInfo) {
            $ngo_name = $ngoInfo->ngo_name;
        } else {
            return redirect()->back()->with('error', 'NGO not found.');
        }
        
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ], 
            [
                'label' => 'NGO List',
                'url' => route('ngoByAdmin')
            ],
            [
                'label' => $ngo_name,
                'url' => null
            ],
        ];
        $ngoMembers = NgoMember::where('ngo_id',$id)->get();

        $ngo_id = $id;
        
        return view('admin.ngo_members.index', compact('breadcrumbs','ngoMembers','ngo_id','ngo_name'));
    }

    public function fetchMemberData($ngo_id){
        
        $result = ['data' => []]; 
        $buttons = '';

        $posts = NgoMember::where('ngo_id',$ngo_id)->orderBy('id', 'desc')->get();
  
        foreach ($posts as $key => $post) {

            $buttons = '<a href="' . route('editMemberData', ['id' => $post->id]) . '" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil" title="Edit Member"></i></a>';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $post->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';
            
            if($post->status == 1) {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-ngo-status" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            }else{ 
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-ngo-status" data-id="'.$post->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }
            
            $image = (!empty($post->image) ? asset('storage/'.$post->image) :  asset('storage/no-image.jpg'));

            $icon = '<img class="img img-thumbnail ngo_list_logo" style="width:70px; height:70px;" src="' . $image . '" >' ."&nbsp;". $post->ngo_name;

           
            
            $result['data'][$key] = [
                $buttons,
                $icon, 
                $post->name,
                $post->designation,
                $status
            ];
        }

        return response()->json($result);
    }

    public function create() 
    {
        return view('ngo_members.create');
    }

    public function memberStoreNgo(Request $request)
    {
        $validatedData = $request->validate([
            'ngo_id' => 'required|exists:ngos,id',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        try {
            $ngo = new NgoMember();
            $ngo->ngo_id = $request->ngo_id;
            $ngo->name = $request->name;
            $ngo->designation = $request->designation;

            if ($request->hasFile('image')) {
                $ngo->image = $request->image->store('ngo', 'public');
            }

            $ngo->save();

            return response()->json(['success' => 'Member has been added successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'An error occurred while creating the Member. Please try again.'
            ], 500);
        }
    }


    public function show(NgoMember $ngoMember)
    {
        return view('ngo_members.show', compact('ngoMember'));
    }

    public function editMember(Request $request)
    {
        $ngo_id = $request->id;

        $ngoMember = NgoMember::select(['id', 'ngo_id','name', 'designation', 'image'])->find($ngo_id);
        
        if (!$ngoMember) {
            return redirect()->route('ngoByAdmin')->with('error', 'Member not found.');
        }

        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'NGO List',
                'url' => route('ngoList')
            ],
            [
                'label' => 'Edit NGO Member By Admin',
                'url' => null
            ],
        ];

        

        return view('admin.ngo_members.edit_member', compact('ngoMember','breadcrumbs'));
    }


    public function updateMember(Request $request)
    {
        $validatedData = $request->validate([
            'member_id' => 'required|exists:ngo_members,id',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $ngoMember = NgoMember::findOrFail($validatedData['member_id']);

        if ($request->hasFile('image')) {
            if ($ngoMember->image) {
                \Storage::delete('public/' . $ngoMember->image);
            }
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        $ngoMember->update($validatedData);

        return response()->json([
            'success' => 'Member has been updated successfully.',
            'updated_member' => $ngoMember
        ]);
    }




    public function destroyNgoMember(Request $request)
    {
        try {
            $member = NgoMember::findOrFail($request->del_id);


            if ($member->image && \Storage::exists($member->image)) {
                \Storage::delete($member->image);
            }

            $member->delete();

            return response()->json(['success' => true, 'messages' => 'Member deleted successfully.']);
        } catch (\Exception $e) {
            \Log::error('Error deleting Member: ' . $e->getMessage());

            return response()->json(['error' => 'An error occurred while deleting the Member. Please try again.'], 500);
        }
    }
}
