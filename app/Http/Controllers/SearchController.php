<?php

namespace App\Http\Controllers;

use App\City;
use App\District;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //
    public function searchFullText( Request $request)
    {
//        dd($request);
        return 'ok';
    }

    public function filterByLocation(Request $request)
    {
        $location = $request->location;
        $subject = $request->subject;
        /** @var Collection $result */
//        SELECT users.id   FROM tutor_subject  INNER JOIN subjects ON tutor_subject.subject_id = subjects.id
//                                                                    INNER JOIN tutors on tutor_subject.tutor_id = tutors.id
//                                                                    INNER JOIN users ON tutors.user_id = users.id
//                                                                    INNER JOIN districts on users.district_id = districts.id

        $userIds = DB::table('tutor_subject')->join('subjects', 'tutor_subject.subject_id', '=', 'subjects.id')
                                            ->join('tutors','tutor_subject.tutor_id', '=', 'tutors.id')
                                            ->join('users','tutors.user_id', '=', 'users.id')
                                            ->join('districts', 'users.district_id', '=', 'districts.id')
                                            ->select('users.id')
                                            ->where('districts.name','like', '%' . $location .  '%')
                                            ->where('subjects.name','like', '%' .$subject . '%')
                                            ->get()->toArray();
        $tutors = [];
        foreach ($userIds as $id){
            $tutors[] = User::find($id->id)->tutor;
        }
        $count = count($tutors);
        $filterString = 'Gia sư tại ' . $location . ', dạy môn học '.$subject;
        return view('search', compact('tutors','count', 'filterString'));
    }
}
