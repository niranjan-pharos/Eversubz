<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessClaim extends Model
{
    use HasFactory;

    protected $table = 'business_claim';

    protected $fillable = [
        'business_id',
        'claimer_name',
        'claimer_email',
        'claimer_phone',
        'claim_reason',
        'relationship_to_business',
        'supporting_documents',
        'status',
        'admin_notes',
        'reviewed_at',
        'reviewed_by',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    /**
     * Get the business that is being claimed
     */
    public function business()
    {
        return $this->belongsTo(UserBusinessInfos::class, 'business_id');
    }

    /**
     * Get the admin user who reviewed the claim
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Scope for pending claims
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for approved claims
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for rejected claims
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Check if claim is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if claim is approved
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if claim is rejected
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Get status badge color for display
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'secondary'
        };
    }
}