<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\UserBusinessInfos;
use App\Models\AdPost;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventEnquiryMail;
use App\Mail\BusinessEnquiryMail;
use Illuminate\Support\Facades\Validator;

 
class EnquiryController extends Controller
{
    public function submitEnquiry(Request $request)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20|regex:/^\+?[0-9\-]+$/',
                'description' => 'nullable|string|max:500',
                'slug' => 'required|string|max:255|regex:/^[\p{L}\p{N}\-\/]+$/u', 
                'module' => 'required|string|in:event,business,adpost,businessappointment',
                'appointment_date' => 'nullable|date_format:Y-m-d\TH:i',
            ])->validate();


            $entity = match ($validatedData['module']) {
                'event' => Event::where('slug', $validatedData['slug'])->first(),
                'business', 'businessappointment' => UserBusinessInfos::where('slug', $validatedData['slug'])->first(),
                'adpost' => AdPost::where('item_url', $validatedData['slug'])->first(),
                default => null,
            };

            if (!$entity) {
                Log::warning('Entity not found for module: ' . $validatedData['module'] . ', slug: ' . $validatedData['slug']);
                return response()->json(['success' => false, 'message' => 'Invalid slug or module.'], 404);
            }

            $enquiry = new Enquiry($validatedData);
            $enquiry->enquiryable()->associate($entity);
            $enquiry->save();

            $author_email = $entity->user->email ?? null;
            if ($author_email) {
                Mail::to($author_email)->send(new EventEnquiryMail($enquiry));
            }

            return response()->json(['success' => true, 'message' => 'Enquiry submitted successfully.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first(),
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error during enquiry submission: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting the form.',
            ], 500);
        }
    }





}
