<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use Str;

class SkillController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Skills',
                'url' => null
            ],
        ];
        return view('admin.skill.index',compact('breadcrumbs'));
    }

    public function fetchTableData(){
        $result = ['data' => []];

        $skills = Skill::select('id','slug', 'skill_name','status','created_at','updated_at')->orderBy('id','DESC')->get();
        
        foreach ($skills as $key => $skill) {
            $buttons = ''; $status  =''; $icon= '';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="editFunc(' . $skill->id . ')" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i></button>';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $skill->id . ')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="fa fa-trash"></i></button>';

            if($skill->status == 1) {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$skill->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            }else{
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$skill->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" ></div>';
            }

            $result['data'][$key] = [
                $skill->skill_name,
                $skill->slug,
                $status,
                optional($skill->created_at)->format('d-m-Y'),
                optional($skill->updated_at)->format('d-m-Y'),
                $buttons,
            ];
        }

        return response()->json($result);
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|min:3|max:255|unique:business_categories',
                'status' => 'required|in:0,1',
            ]);

            $name = $request->input('name');
            $slug = Str::slug($name);
            $status = $request->input('status');
            
            Skill::create([
                'skill_name' => $name,
                'slug' => $slug,
                'status' => $status,
            ]);

            return response()->json(['messages' => 'Skill added successfully', 'status' => true], 200);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            $errors = $validationException->errors();
            return response()->json(['error' => $errors, 'status' => false]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while adding the record', 'status' => false], 500);
        }
    }

    public function skillEdit(string $id)
    {
        $skill = Skill::find($id);

        return response()->json(['skill' => $skill, 'status' => true], 200);
    }

    
    public function skillUpdate(Request $request)
    {
        try {
            $rules = [
                'skill_id' => 'required|exists:skills,id',
                'edit_name' => 'required|string|min:3|max:255',
                'edit_status' => 'required|in:0,1',
            ];

            $messages = [
                'skill_id.exists' => 'Invalid Skill id.',
                'edit_name.required' => 'The skill name field is required.',
                'edit_status.in' => 'Invalid status value.',
            ];

            $skill = Skill::find($request->input('skill_id'));
            
            if (!$skill) {
                return response()->json(['error' => 'Skill not found']);
            }

            $request->validate($rules, $messages);

            $slug = Str::slug($request->input('edit_name'));
            $skill->update([
                'skill_name' => $request->input('edit_name'),
                'slug' => $slug,
                'status' => $request->input('edit_status'),
            ]);

            return response()->json(['success' => true, 'messages' => 'Skill updated successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            $errors = $validationException->errors();
            return response()->json(['error' => $errors, 'success' => false]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the record', 'success' => false]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $skillId = $request->input('del_id');
            $skill = Skill::find($skillId);
    
            if (!$skill) {
                return response()->json(['error' => false, 'messages' => 'Skill not found']);
            }
    
            $skill->delete();
    
            return response()->json(['success' => true, 'messages' => 'Skill deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'messages' => 'Error deleting Skill']);
        }
    }

    // change status
    public function changeSkillStatus(Request $request){

        $skill = Skill::findOrFail($request->id);
        $skill->status = $request->status == 'true' ? 1 : 0;
        $skill->save();
        
        return response(['message' => 'status changed successfully']);
    }

    public function getSkills(Request $request)
    {
        $searchTerm = $request->input('q');
        
        $skills = Skill::where('skill_name', 'like', '%' . $searchTerm . '%')
                    ->where('status', 1)
                    ->get();

        return response()->json([
            'results' => $skills->map(function($skill) {
                return ['id' => $skill->id, 'text' => $skill->skill_name];
            })
        ]);
    }



}
