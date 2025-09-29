<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CityController extends Controller
{
    public function index(Request $request)
    {
        $query = strtolower($request->input('q'));

        $cities = ['Adelaide South Australia', 'Brisbane Queensland', 'Cairns, Queensland', 'Canberra, Australian Capital Territory ','Darwin, Northern Territory', 'Dubbo, New South Wales' ,'Devonport, Tasmania', 'Echuca, Victoria', 'Esperance, Western Australia','Exmouth, Western Australia','Fremantle, Western Australia','Frankston, Victoria','Forbes, New South Wales','Geelong, Victoria', 'Gold Coast, Queensland','Hobart (Tasmania)', 'Logan City', 'Melbourne, Victoria', 'Newcastle', 'Perth Western Australia', 'Sydney, New South Wales','Sunshine Coast, Queensland','Shepparton, Victoria','Shellharbour, New South Wales','Singleton, New South Wales', 'Swan Hill, Victoria','Sale, Victoria','Scone, New South Wales','Stirling, South Australia','Toowoomba, Queensland', 'Townsville, Queensland', 'Wollongong, New South Wales'
        ];

        $filteredCities = array_filter($cities, function ($city) use ($query) {
            return Str::startsWith(strtolower($city), $query);
        });

        return response()->json(array_values($filteredCities));
    }
}
