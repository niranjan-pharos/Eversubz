<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $pageTitle = 'Profile';
        $breadcrumb = 'Profile';
        return view('admin.profile.index',compact('pageTitle','breadcrumb'));
    }

    public function update(Request $request){
        dd($request);
    }


}
