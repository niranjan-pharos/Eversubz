<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBusinessInfos;
use App\Models\Fundraising;
use App\Models\User;
use App\Models\Donation;
use App\Models\FundraisingImage;
use App\Models\FundraisingCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
 

class FundraisingController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Fundraisings',
                'url' => null
            ],
        ];
        return view('admin.fundraising.index',compact('breadcrumbs'));
    }

    public function fetchFundraisingData()
    {
        $result = ['data' => []];
    
        $fundraisings = Fundraising::select('id', 'main_image', 'title', 'slug', 'status', 'location', 'from_date_time', 'to_date_time', 'user_id', 'featured','created_at','updated_at')
            ->with(['user:id,name,username'])
            ->orderBy('id', 'desc')
            ->get();
    
        foreach ($fundraisings as $key => $fundraising) {
            $buttons = '';
            $featured = '';
    
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="ViewDonation(' . $fundraising->id . ')"><i class="fa fa-money"></i></button>';
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="viewFunc(' . $fundraising->id . ')"><i class="fa fa-eye"></i></button>';
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="removeFunc(\'' . $fundraising->slug . '\')" ><i class="fa fa-trash"></i></button>';
    
            if ($fundraising->status == 'active') {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$fundraising->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            } else {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$fundraising->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked"></div>';
            }
    
            if ($fundraising->featured == 1) {
                $featured = '<div class="form-check form-switch">
                <input class="form-check-input featured-status" data-id="'.$fundraising->id.'" type="checkbox" role="switch" id="flexSwitchFeatureCheckChecked" checked></div>';
            } else { 
                $featured = '<div class="form-check form-switch">
                <input class="form-check-input featured-status" data-id="'.$fundraising->id.'" type="checkbox" role="switch" id="flexSwitchFeatureCheckChecked"></div>';
            }
    
            $imagePath = $fundraising->main_image ? asset('storage/' . $fundraising->main_image) : asset('storage/no-image.jpg');
    
            $from_date_time = new DateTime($fundraising->from_date_time);
            $to_date_time = new DateTime($fundraising->to_date_time);
    
            $from_formattedDate = $from_date_time->format('D jS M Y, g:i a');
            $to_formattedDate = $to_date_time->format('D jS M Y, g:i a T');
    
            $dateTimeDisplay = $from_formattedDate . ' - ' . $to_formattedDate;
    
            $result['data'][$key] = [
                '<img src="' . $imagePath . '" alt="Fundraising Image" class="img-thumbnail" style="width: 100px; height: 100px;">',
                $fundraising->title,
                $fundraising->user ? $fundraising->user->username : '',
                $fundraising->location,
                $dateTimeDisplay,
                $featured,
                $status,
                optional($fundraising->created_at)->format('d-m-Y'),
                optional($fundraising->updated_at)->format('d-m-Y'),
                $buttons,
            ];
        }
    
        return response()->json($result);
    }

    public function Donation(){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Donation',
                'url' => null
            ],
        ];
        return view('admin.donation.index',compact('breadcrumbs'));
    }

    public function fetchDonationgData(Request $request)
    {
        $fundraising_id = $request->query('fundraising_id');

        $donations = Donation::with(['fundraising:id,title', 'user:id,name'])
            ->where('fundraising_id', $fundraising_id)
            ->orderBy('id', 'desc')
            ->get();

        $data = [];
        foreach ($donations as $d) {
            $created_at = $d->created_at ? $d->created_at->format('D jS M Y, g:i a') : '';
            $buttons = '<button class="btn btn-sm" onclick="viewDonation(' . $d->id . ')">View</button>';
            $buttons .= '<button class="btn btn-sm" onclick="removeDonation(' . $d->id . ')">Delete</button>';

            $data[] = [
                $d->donation_number,
                $d->fundraising->title ?? 'N/A',
                $d->first_name . ' ' . $d->last_name,
                $d->email,
                $d->amount,
                $d->tip,
                $d->total_amount,
                $d->country,
                ucfirst($d->payment_status),
                $created_at,
                $buttons
            ];
        }

        return response()->json(['data' => $data]);
    }





    public function changeFundraisingsStatus(Request $request)
    {
        $fundraising = Fundraising::findOrFail($request->id);
        $fundraising->status = $request->status; // Save 'active' or 'inactive'
        $fundraising->save();

        return response(['message' => 'Status changed successfully']);
    }
    
    public function changeFundraisingFeatured(Request $request)
    {
        $fundraising = Fundraising::findOrFail($request->id);
        $fundraising->featured = $request->status == 'true' ? 1 : 0;
        $fundraising->save();
    
        return response()->json(['message' => 'Featured status changed']);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Fundraising List',
                'url' => route('adminFundraising')
            ],
            [
                'label' => 'Details',
                'url' => null
            ],
        ];
        $fundraising = Fundraising::with(['fundraisingImages', 'category', 'user'])->findOrFail($id);
    //  dd($fundraising);
        return view('admin.fundraising.show', compact('fundraising','breadcrumbs'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyBySlug(Request $request)
    {
        $slug = $request->slug;
        $fundraising = Fundraising::where('slug', $slug)->firstOrFail();
        $fundraising->delete();
    
        return response()->json(['message' => 'Fundraising item deleted']);
    }
}
