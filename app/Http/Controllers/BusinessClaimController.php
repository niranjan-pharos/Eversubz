<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessClaimRequest;
use App\Models\BusinessClaim;
use App\Models\UserBusinessInfos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BusinessClaimController extends Controller
{
    /**
     * Display the claim form modal (AJAX request)
     */
    public function create(Request $request)
    {
        $businessId = $request->get('business_id');
        $business = UserBusinessInfos::findOrFail($businessId);

        if ($request->ajax()) {
            return view('business.details', compact('business'))->render();
        }

        return view('business.details', compact('business'));
    }

    /**
     * Store a newly created claim
     */
    public function store(BusinessClaimRequest $request)
    {
        dd($request);
        try {
            $data = $request->validated();

            // Handle file upload for supporting documents
            if ($request->hasFile('supporting_documents')) {
                $file = $request->file('supporting_documents');
                $filename = time() . '_' . Str::slug($data['claimer_name']) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('business-claims', $filename, 'public');
                $data['supporting_documents'] = $path;
            }

            $claim = BusinessClaim::create($data);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your claim has been submitted successfully! We will review it and get back to you soon.',
                    'claim_id' => $claim->id
                ]);
            }

            return redirect()->back()->with('success', 'Your claim has been submitted successfully!');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'There was an error submitting your claim. Please try again.',
                    'error' => $e->getMessage()
                ], 422);
            }

            return redirect()->back()
                ->withErrors(['error' => 'There was an error submitting your claim.'])
                ->withInput();
        }
    }

    /**
     * Display all claims (Admin only)
     */
    public function index(Request $request)
    {
        $query = BusinessClaim::with(['business', 'reviewer']);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('claimer_name', 'like', "%{$search}%")
                  ->orWhere('claimer_email', 'like', "%{$search}%")
                  ->orWhereHas('business', function($businessQuery) use ($search) {
                      $businessQuery->where('business_name', 'like', "%{$search}%");
                  });
            });
        }

        $claims = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.claims.index', compact('claims'));
    }

    /**
     * Show specific claim details
     */
    public function show(BusinessClaim $claim)
    {
        $claim->load(['business', 'reviewer']);
        return view('admin.claims.show', compact('claim'));
    }

    /**
     * Update claim status (Admin only)
     */
    public function updateStatus(Request $request, BusinessClaim $claim)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $claim->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id()
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Claim status updated successfully!'
            ]);
        }

        return redirect()->back()->with('success', 'Claim status updated successfully!');
    }

    /**
     * Check if business has existing claims
     */
    public function checkExistingClaims(Request $request)
    {
        $businessId = $request->get('business_id');
        $email = $request->get('email');

        $existingClaim = BusinessClaim::where('business_id', $businessId)
            ->where('claimer_email', $email)
            ->where('status', 'pending')
            ->exists();

        return response()->json([
            'has_existing_claim' => $existingClaim
        ]);
    }

    /**
     * Download supporting documents
     */
    public function downloadDocument(BusinessClaim $claim)
    {
        if (!$claim->supporting_documents || !Storage::disk('public')->exists($claim->supporting_documents)) {
            abort(404, 'Document not found');
        }

        return Storage::disk('public')->download($claim->supporting_documents);
    }
}