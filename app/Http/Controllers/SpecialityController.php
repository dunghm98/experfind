<?php

namespace App\Http\Controllers;

use App\Speciality;
use function Sodium\add;

/**
 * Class SpecialityController
 *
 * @package App\Http\Controllers
 */
class SpecialityController extends Controller
{
    /**
     * @return Speciality[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        if (request()->has('name')) {
            $specialities = Speciality::where('name', 'like', '%' . request('name') . '%')->get();
        } else {
            $specialities = Speciality::all();
        }

        return request()->ajax() ?
            response()->json([
                'status' => 200,
                'data' => $specialities
            ]) :
            $specialities;
    }

    public function getList()
    {
        try {
            $specialities = collect();
            if (request()->has('specialities')) {
                $specialityIds = request('specialities');
                foreach ($specialityIds as $id) {
                    $specialities = $specialities->add(Speciality::find($id));
                }


            } else {
                $specialities = Speciality::all();
            }
            return request()->ajax() ?
                response()->json([
                    'status' => 200,
                    'data' => $specialities
                ]) :
                $specialities;

        } catch (\Exception $e) {
            return request()->ajax() ?
                response()->json([
                    'status' => 400,
                    'data' => $e->getMessage()
                ]) :
                $e->getMessage();
        }
    }
}
