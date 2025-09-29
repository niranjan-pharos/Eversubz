<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('website.contact');

    }

    public function generateCaptcha()
{
    // Generate a random string for the CAPTCHA
    $captchaCode = Str::random(6);
    Session::put('captcha_code', $captchaCode); // Store in session

    // Create an image with the CAPTCHA code
    $image = imagecreate(120, 40);
    $backgroundColor = imagecolorallocate($image, 255, 255, 255);
    $textColor = imagecolorallocate($image, 0, 0, 0);
    imagestring($image, 5, 10, 10, $captchaCode, $textColor);

    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();

    imagedestroy($image);

    return response($imageData)->header('Content-Type', 'image/png');
}
public function submitForm(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|regex:/^[0-9]{10}$/',
        'address' => 'nullable|string|max:255',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    Contact::create($request->only(['name', 'email', 'phone', 'address', 'subject', 'message']));

    return response()->json(['success' => 'Your message has been submitted successfully!']);
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
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
