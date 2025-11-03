<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonationPackage;
use App\Models\DonatePackage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\DonationPackageImage;


class DonationPackageController extends Controller
{
    // Display all donation packages
    public function index()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Donation Packages',
                'url' => null
            ],
        ];
        return view('admin.donationa_packages.index',compact('breadcrumbs'));

    }

    public function fetchTableData()
    {
        $result = ['data' => []]; 

        $donationPackages = DonationPackage::select('id', 'name', 'image', 'price', 'quantity', 'status', 'created_at', 'updated_at', 'ngo_id')
            ->orderBy('id', 'desc')
            ->get();
        
        foreach ($donationPackages as $key => $package) {
            $buttons = '';
            $feature = '';
            $status = '';

            $buttons .= '<a href="' . route('editDonationPackageData', ['id' => $package->id]) . '" type="button" class="btn btn-default btn-sm" ><i class="fa fa-pencil" title="Edit Donation"></i></a>';
            
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="viewFunc(' . $package->id . ')"><i class="fa fa-eye"></i></button>';
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="removeFunc(\'' . $package->id . '\')" ><i class="fa fa-trash"></i></button>';

            if ($package->status == 1) {
                $status = '<div class="form-check form-switch">
                            <input class="form-check-input change-status" data-id="'.$package->id.'" type="checkbox" role="switch" checked>
                           </div>';
            } else {
                $status = '<div class="form-check form-switch">
                            <input class="form-check-input change-status" data-id="'.$package->id.'" type="checkbox" role="switch">
                           </div>';
            }

            $imagePath = $package->image ? asset('storage/' . $package->image) : asset('storage/no-image.jpg');

            $created_at = optional($package->created_at)->format('d-m-Y');
            $updated_at = optional($package->updated_at)->format('d-m-Y');
            
            $result['data'][$key] = [
                '<img src="' . $imagePath . '" alt="Package Image" class="img-thumbnail" style="width: 100px; height: 100px;">',
                $package->name,
                '$' . number_format($package->price, 2),
                $package->quantity,
                $status,
                $created_at,
                $updated_at,
                $buttons,
            ];
        }

        return response()->json($result);
    }

    public function listingData()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Donation Packages Listing',
                'url' => null
            ],
        ];
        return view('admin.donationa_packages.donation-listing',compact('breadcrumbs'));

    }


    public function fetchTableListingData()
    {
        $result = ['data' => []]; 

        $donationPackages = DonatePackage::orderBy('id', 'desc')
            ->get();
        
        foreach ($donationPackages as $key => $package) {

            $created_at = optional($package->created_at)->format('d-m-Y');
            $updated_at = optional($package->updated_at)->format('d-m-Y');

            $itemStatus = strtolower($package->status);

            if ($itemStatus === 'pending') {
                $itemStatusHtml = '<span class="item-status-badge item-status-pending"><span class="item-status-dot"></span>' . ucfirst($itemStatus) . '</span>';
            } elseif ($itemStatus === 'successful') {
                $itemStatusHtml = '<span class="item-status-badge item-status-success"><span class="item-status-dot"></span>' . ucfirst($itemStatus) . '</span>';
            } elseif ($itemStatus === 'failed') {
                $itemStatusHtml = '<span class="item-status-badge item-status-failed"><span class="item-status-dot"></span>' . ucfirst($itemStatus) . '</span>';
            } else {
                $itemStatusHtml = '<span class="item-status-badge"><span class="item-status-dot"></span>' . ucfirst($itemStatus) . '</span>';
            }
            
            $result['data'][$key] = [
                $package->id,
                $package->name,
                $package->email,
                $package->phone_number ?? '-',
                $package->amount,
                $package->quantity,
                $package->total_amount,
                $itemStatusHtml,
                $package->donation_number,
                $created_at,
                $updated_at
            ];
        }

        return response()->json($result);
    }

    

    public function create()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Add Donation Packages',
                'url' => null
            ],
        ];
        return view('admin.donationa_packages.add_package',compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ngo_id'            => 'nullable|exists:ngos,id',
            'name'              => 'required|string|max:255',
            'in_packages'       => 'nullable|string',
            'description'       => 'nullable|string',
            'price'             => 'nullable|numeric|min:0|max:999999.99',
            'quantity'          => 'required|integer|min:1',
            'decide_by_eversabz'=> 'sometimes|boolean',
            'status'            => 'sometimes|boolean',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'gallery'           => 'sometimes|array',
            'gallery.*'         => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ], [
            'image.max' => 'The image size cannot exceed 5MB.',
        ]);

        // Save main image if uploaded
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('donation_package', 'public');
        }

        // First create the DonationPackage
        $donationPackage = \App\Models\DonationPackage::create($validated);

        // Then handle gallery images
        if ($request->hasFile('gallery')) {
            $position = 0;
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('donation-package/gallery', 'public'); 

                \App\Models\DonationPackageImage::create([
                    'donation_package_id' => $donationPackage->id,
                    'image'               => $path,
                    'position'            => $position++,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Donation package created successfully.',
        ], 201);
    }


    public function show($id)
    {
        $donationPackage = DonationPackage::with('gallery')->findOrFail($id);

        if (!$donationPackage) {
            return response()->json(['message' => 'Donation package not found'], 404);
        }

        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'View Donation Packages',
                'url' => null
            ],
        ];
        return view('admin.donationa_packages.show',compact('breadcrumbs','donationPackage'));
    }

    public function edit($id)
    {
        $product_id = $id;
        

        $donationInfo = DonationPackage::with('gallery')->findOrFail($product_id);
        if (!$donationInfo) {
            return redirect()->back()->with('error', 'Donation Package not found.');
        }
        $product_title = $donationInfo->name;
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('adminDashboard')],
            ['label' => 'Donation Package', 'url' => route('adminDonationPackages')],
            ['label' => "Edit Donation Package - $product_title", 'url' => null]
        ]; 
        return view('admin.donationa_packages.edit_package', compact('breadcrumbs','donationInfo'));
    }

    public function update(Request $request, $id)
    {
        $donation = DonationPackage::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'in_packages' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        // ✅ Handle main image
        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($donation->image && Storage::disk('public')->exists($donation->image)) {
                Storage::disk('public')->delete($donation->image);
            }

            $data['image'] = $request->file('image')->store('donation_packages', 'public');
        }

        // ✅ Update main donation data
        $data['status'] = $request->has('status') ? 1 : 0;
        $donation->update($data);

        // ✅ Handle multiple gallery uploads (create separate DB records)
        if ($request->hasFile('gallery')) {
            $position = DonationPackageImage::where('donation_package_id', $donation->id)->max('position') ?? 0;

            foreach ($request->file('gallery') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('donation-package/gallery', 'public');

                    DonationPackageImage::create([
                        'donation_package_id' => $donation->id,
                        'image' => $path,
                        'position' => ++$position,
                    ]);
                }
            }
        }

        return response()->json(['message' => 'Donation package updated successfully!']);
    }


    public function changeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:donation_packages,id', 
            'status' => 'required',
        ]);

        try {
            $donation_packagge = DonationPackage::find($request->id);

            if ($donation_packagge) {
                $newStatus = $donation_packagge->status == 0 ? 1 : 0;

                $donation_packagge->status = $newStatus;
                $donation_packagge->save();

                return response()->json([
                    'message' => 'status changed successfully.',
                    'status' => $newStatus
                ]);
            } else {
                return response()->json(['error' => 'Donation Package not found'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error updating Donation Package status', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while updating the status.'], 500);
        }
    }

    public function destroy($id)
    {
        $donationPackage = DonationPackage::find($id);

        if (!$donationPackage) {
            return response()->json(['message' => 'Donation package not found'], 404);
        }

        if ($donationPackage->image) {
            Storage::disk('public')->delete($donationPackage->image);
        }

        $donationPackage->delete();

        return response()->json(['status' => true, 'message' => 'Donation package deleted successfully']);
    }


    public function deleteGallery(Request $request)
    {
        $image = DonationPackageImage::find($request->id);

        if (!$image) {
            return response()->json(['message' => 'Image not found.'], 404);
        }

        // Delete file from storage
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        // Delete DB record
        $image->delete();

        return response()->json(['message' => 'Gallery image deleted successfully.']);
    }
}
