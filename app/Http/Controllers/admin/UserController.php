<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\userBusinessInfos;
use App\Models\event;


class UserController extends Controller
{
    public function index()
    {
        //
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Users',
                'url' => null
            ],
        ];
        
        return view('admin.users.index',compact('breadcrumbs'));
    }



    public function fetchTableData()
    {
        $result = ['data' => []];

        $users = User::select('id', 'uid','name', 'username', 'account_type', 'email', 'phone', 'created_at', 'status', 'is_admin_approved', 'is_module_visible')
            ->orderBy('id', 'desc')
            ->get();

        $accountTypeMap = [
            1 => 'Normal User',
            2 => 'Business A/c',
            3 => 'NGO A/c',
            4 => 'Candidate Profile'
        ];

        foreach ($users as $key => $user) {
            $buttons = '';  
            $buttons = '<div class="action-buttons">';
            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="viewUser(' . $user->id . ')"><i class="fa fa-eye"></i></button>';
            $buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="removeUser(' . $user->id . ')"><i class="fa fa-trash"></i></button>';
            $buttons .= '</div>';

            $accountTypeName = $accountTypeMap[$user->account_type] ?? 'Unknown';

            $statusChecked = $user->status == 'active' ? 'checked' : '';
            $statusSwitch = '
                <div class="form-check form-switch">
                    <input class="form-check-input status-switch" type="checkbox" role="switch" id="statusSwitch' . $user->id . '" ' . $statusChecked . ' data-user-id="' . $user->id . '">
                </div>';

            $adminApprovedChecked = $user->is_admin_approved == 1 ? 'checked' : '';
            $adminApprovedSwitch = '
                <div class="form-check form-switch">
                    <input class="form-check-input admin-approved-switch" type="checkbox" role="switch" id="adminApprovedSwitch' . $user->id . '" ' . $adminApprovedChecked . ' data-user-id="' . $user->id . '">
                </div>';

            $moduleVisible = $user->is_module_visible == 1 ? 'checked' : '';
            $moduleVisible = '
                <div class="form-check form-switch">
                    <input class="form-check-input module-enable-switch" type="checkbox" role="switch" id="moduleVisible' . $user->id . '" ' . $moduleVisible . ' data-user-id="' . $user->id . '">
                </div>';

                $accountTypeMap = [
                    1 => ['label' => 'Normal User',     'class' => 'info'],
                    2 => ['label' => 'Business A/c',    'class' => 'primary'],
                    3 => ['label' => 'NGO A/c',         'class' => 'success'],
                    4 => ['label' => 'Candidate Profile','class' => 'warning'],
                ];

                $accountType = $accountTypeMap[$user->account_type] ?? ['label' => 'Unknown', 'class' => 'secondary'];

                $accountTypeHtml = '<span class="status-badge bg-' . $accountType['class'] . '-faint text-' . $accountType['class'] . '-dark">
                                       <span class="status-dot bg-' . $accountType['class'] . '-dark"></span>' . $accountType['label'] . '
                                    </span>';


            $result['data'][$key] = [
                $buttons, 
                optional($user->created_at)->format('d-m-Y'),
                $user->uid,
                $user->email,
                $accountTypeHtml,
                $user->phone,
                $statusSwitch,
                $adminApprovedSwitch,
                $moduleVisible
            ];
        }

        return response()->json($result);
    }

    public function updateUserStatus(Request $request) 
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:0,1' 
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            $user->status = $request->status == 1 ? 'active' : 'inactive'; 
            $user->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function updateAdminApproved(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'is_admin_approved' => 'required|boolean'
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            $user->is_admin_approved = $request->is_admin_approved;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Admin approved status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateModuleVisible(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'is_module_visible' => 'required|boolean'
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            $user->is_module_visible = $request->is_module_visible;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Module visibbility updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    

    public function destroy(Request $request)
    {
        try {
            $userId = $request->input('id');
            $user = User::find($userId);

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found']);
            }

            $relatedAdPostsCount = $user->adPosts()->count();
            
            $relatedBusinessInfosCount = $user->BusinessInfos()->count();
            
            $relatedEventsCount = $user->events()->count();

            if ($relatedAdPostsCount > 0 || $relatedBusinessInfosCount > 0 || $relatedEventsCount > 0) {
                $message = 'Please delete related Ad Posts, Business Infos, or Events before deleting this user.';

                if ($relatedAdPostsCount > 0 && $relatedBusinessInfosCount > 0 && $relatedEventsCount > 0) {
                    $message = 'Please delete related Ad Posts, Business Infos, and Events before deleting this user.';
                } elseif ($relatedAdPostsCount > 0 && $relatedBusinessInfosCount > 0) {
                    $message = 'Please delete related Ad Posts and Business Infos before deleting this user.';
                } elseif ($relatedAdPostsCount > 0 && $relatedEventsCount > 0) {
                    $message = 'Please delete related Ad Posts and Events before deleting this user.';
                } elseif ($relatedBusinessInfosCount > 0 && $relatedEventsCount > 0) {
                    $message = 'Please delete related Business Infos and Events before deleting this user.';
                } elseif ($relatedAdPostsCount > 0) {
                    $message = 'Please delete related Ad Posts before deleting this user.';
                } elseif ($relatedBusinessInfosCount > 0) {
                    $message = 'Please delete related Business Infos before deleting this user.';
                } elseif ($relatedEventsCount > 0) {
                    $message = 'Please delete related Events before deleting this user.';
                }

                return response()->json(['success' => false, 'message' => $message]);
            }

            // Now delete the user
            $user->delete();

            return response()->json(['success' => true, 'message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Error deleting user: " . $e->getMessage()]);
        }
    }


    public function viewUser($id)
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'User List',
                'url' => route('user.listing')
            ],
            [
                'label' => 'User Details',
                'url' => null
            ],
        ];
        
        $user = User::findOrFail($id);
        $userDetail = UserDetail::where('user_id', $id)->first(); 
        
        return view('admin.users.view', compact('user', 'userDetail', 'breadcrumbs'));
    }

    public function searchUser(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $users = User::where('name', 'like', '%' . $searchTerm . '%')->get();

        $result = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'text' => $user->name,
            ];
        });

        return response()->json($result);
    }


    public function deletedUser()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Deleted Users',
                'url' => null
            ],
        ];
        
        return view('admin.users.deleted_users',compact('breadcrumbs'));
    }



    public function fetchDeletedUserData()
    {
        $result = ['data' => []];

        $users = User::withTrashed()
            ->select('id', 'uid','name', 'username', 'account_type', 'email', 'phone', 'created_at', 'deleted_at')
            ->whereNotNull('deleted_at')
            ->orderBy('id', 'desc')
            ->get();

        $accountTypeMap = [
            1 => 'Normal User',
            2 => 'Business A/c',
            3 => 'NGO A/c',
            4 => 'Candidate Profile'
        ];

        foreach ($users as $key => $user) {
            $accountTypeName = $accountTypeMap[$user->account_type] ?? 'Unknown';

             $accountTypeMap = [
                    1 => ['label' => 'Normal User',     'class' => 'info'],
                    2 => ['label' => 'Business A/c',    'class' => 'primary'],
                    3 => ['label' => 'NGO A/c',         'class' => 'success'],
                    4 => ['label' => 'Candidate Profile','class' => 'warning'],
                ];

                $accountType = $accountTypeMap[$user->account_type] ?? ['label' => 'Unknown', 'class' => 'secondary'];

                $accountTypeHtml = '<span class="status-badge bg-' . $accountType['class'] . '-faint text-' . $accountType['class'] . '-dark">
                                       <span class="status-dot bg-' . $accountType['class'] . '-dark"></span>' . $accountType['label'] . '
                                    </span>';

            $is_deleted = !empty($user->deleted_at) ? '' : 'checked';
            $restoreSwitch = '
                <div class="form-check form-switch">
                    <input class="form-check-input restore-switch" type="checkbox" role="switch" id="restoreSwitch' . $user->id . '" ' . $is_deleted . ' data-user-id="' . $user->id . '">
                </div>';

            $formattedDeletedAt = $user->deleted_at ? $user->deleted_at->format('d-m-Y H:i:s') : '';

            $result['data'][$key] = [
                $user->uid,
                $user->name,
                $user->username,
                $accountTypeHtml,
                $user->email,
                $user->phone,
                $restoreSwitch,
                $formattedDeletedAt,
            ];
        }

        return response()->json($result);
    }

    public function updateUserRestore(Request $request) 
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:0,1' 
        ]);

        try {
            $user = User::withTrashed()->findOrFail($request->user_id);
            
            if ($request->status == 1) {
                $user->restore(); 
                $user->status = 'active';
                $user->save();
                
                return response()->json([
                    'success' => true, 
                    'message' => 'User restored successfully'
                ]);
            }
            
            return response()->json([
                'success' => false, 
                'message' => 'No action performed: Status not set to restore'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Failed to restore user: ' . $e->getMessage()
            ], 500);
        }
    }
    
}
