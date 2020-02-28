<?php

namespace App\Http\Controllers;

use App\Speciality;
use App\Subject;
use Illuminate\Http\Request;
use function Sodium\add;

/**
 * Class SubjectController
 *
 * @package App\Http\Controllers
 */
class SubjectController extends Controller
{
    /**
     * @return Speciality|\Illuminate\Http\JsonResponse
     */
    public function getBySpeciality()
    {
        $subjectName = request('name');
        $specialities = request('specialities');
        $subjects = collect();
        foreach ($specialities as $speciality) {
            $speciality = Speciality::find($speciality);
            if (request()->has('name')) {
                $subjects = $subjects->merge($speciality->subjects()->where('name', 'like', '%' . $subjectName . '%')->get());
            }
            else {
                $subjects = $subjects->merge($speciality->subjects);
            }
        }

        return request()->ajax() ?
            response()->json([
                'status' => 200,
                'data' => $subjects
            ]) :
            $subjects;
    }

    /**
     * @return Subject[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\JsonResponse|\Illuminate\Support\Collection|string
     */
    public function getList()
    {
        try {
            $subjects = collect();
            if (request()->has('subjects')) {
                $subjectIds = request('subjects');
                foreach ($subjectIds as $id) {
                    $subjects = $subjects->add(Subject::find($id));
                }


            } else {
                $subjects = Subject::all();
            }
            return request()->ajax() ?
                response()->json([
                    'status' => 200,
                    'data' => $subjects->unique()->all()
                ]) :
                $subjects;

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
