<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function getDistrictList(Request $request, \App\City $city)
    {
        try {
            $districts = $city->districts;
            return response()->json([
                'status' => 200,
                'data' => $districts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'data' => $e->getMessage()
            ]);
        }
    }
}
