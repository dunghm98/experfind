<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function index()
    {
        $cities = \App\City::all();
//        $countries = DB::table("countries")->pluck("name","id");
        return view('index',compact('cities'));
    }

    public function getDistrictList(Request $request)
    {
        $districts = \App\District::where('city_id',$request->city_id)->get();
        return response()->json($districts);
//        $states = DB::table("states")
//            ->where("country_id",$request->country_id)
//            ->pluck("name","id");
//        return response()->json($states);
    }

}
