<?php

namespace App\Http\Controllers;

use App\Models\ContactSeller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactSellerController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
            'product_slug' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
        }

        ContactSeller::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'product_slug' => $request->product_slug,
        ]);

        return response()->json(['success' => true, 'message' => 'Message sent successfully']);
    }
}