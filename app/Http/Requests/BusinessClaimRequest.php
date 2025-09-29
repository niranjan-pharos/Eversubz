<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessClaimRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'business_id' => 'required|exists:user_business_infos,id',
            'claimer_name' => 'required|string|max:255',
            'claimer_email' => 'required|email|max:255',
            'claimer_phone' => 'required|string|max:20',
            'claim_reason' => 'required|string|max:1000',
            'relationship_to_business' => 'nullable|string|max:255',
            'supporting_documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // 5MB max
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'business_id.required' => 'Business selection is required.',
            'business_id.exists' => 'Selected business does not exist.',
            'claimer_name.required' => 'Your name is required.',
            'claimer_name.max' => 'Name cannot exceed 255 characters.',
            'claimer_email.required' => 'Email address is required.',
            'claimer_email.email' => 'Please provide a valid email address.',
            'claimer_phone.required' => 'Phone number is required.',
            'claimer_phone.max' => 'Phone number cannot exceed 20 characters.',
            'claim_reason.required' => 'Please provide a reason for claiming this business.',
            'claim_reason.max' => 'Claim reason cannot exceed 1000 characters.',
            'relationship_to_business.max' => 'Relationship description cannot exceed 255 characters.',
            'supporting_documents.file' => 'Supporting documents must be a valid file.',
            'supporting_documents.mimes' => 'Supporting documents must be a PDF, DOC, DOCX, JPG, JPEG, or PNG file.',
            'supporting_documents.max' => 'Supporting documents cannot exceed 5MB in size.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'business_id' => 'business',
            'claimer_name' => 'name',
            'claimer_email' => 'email',
            'claimer_phone' => 'phone',
            'claim_reason' => 'claim reason',
            'relationship_to_business' => 'relationship to business',
            'supporting_documents' => 'supporting documents',
        ];
    }
}