<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdsCardsListController extends Controller
{
    public function index()
    {
        return view('website.ads-cards-lists.index');
    }


    public function show($id){

        $package = [
            'id' => $id,
            'title' => 'Winter Kit For Street Children',
            'price' => 83.52,
            'image' => "https://assets.aseelapp.com/cdn-cgi/image/,format=auto,quality=90/https://assets.aseelapp.com/images/file_01JFEV7TCP6AV8FTKDPVNHAASX.jpg",
            'description' => 'Essential food supplies for families in need, including flour, oil, rice, and lentils.',
        ];
        return view('website.ads-cards-lists.package_show', compact('package'));
    }


    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if($query) {
            $users = User::where('uid', 'LIKE', "%{$query}%")
                        ->select('id', 'name','uid','email')
                        ->limit(10)
                        ->get();
        } else {
            $users = collect(); // empty collection
        }

        return response()->json($users);
    }
}
