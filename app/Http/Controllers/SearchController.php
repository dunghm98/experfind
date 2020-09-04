<?php

namespace App\Http\Controllers;

use App\City;
use App\District;
use App\Speciality;
use App\Subject;
use App\Tutor;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    const BOTH_GENDER = 3;
    const MALE = 1;
    const FEMALE = 0;
    const BOTH_TYPE = 3;
    const STUDENT = 0;
    const TEACHER = 1;

    private $genderName;
    private $tutorType;
    private $districtName;
    private $cityName;
    private $subjectName;
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

        $query = DB::table('tutor_subject')
                                            ->join('subjects', 'tutor_subject.subject_id', '=', 'subjects.id')
                                            ->join('specialities', 'subjects.speciality_id', '=', 'specialities.id')
                                            ->join('tutors','tutor_subject.tutor_id', '=', 'tutors.id')
                                            ->join('users','tutors.user_id', '=', 'users.id')
                                            ->join('districts', 'users.district_id', '=', 'districts.id')
                                            ->join('cities', 'users.city_id', '=', 'cities.id')
                                            ->select('tutors.id');
        if (!empty($location)){
             $query->where('districts.name','like', '%' . $location .  '%')
                    ->orWhere('cities.name','like', '%' . $location .  '%');
        }
        if (!empty($subject)){
            $query->where('subjects.name','like', '%' .$subject . '%')
            ->orWhere('specialities.name','like', '%' . $subject .  '%');
        }

        $userIds = $query->get()->unique()->toArray();
        $tutors = [];
        foreach ($userIds as $id){
            $tutors[] = Tutor::find($id->id);
        }
        $count = count($tutors);
        $filterString = 'Gia sư tại ' . $location . ', dạy môn học '.$subject;
        $specialities = Speciality::all();
        $cities = \App\City::all();
        $districts = \App\District::all();
        return view('search', compact('tutors', 'specialities', 'cities', 'districts', 'count', 'filterString'));
    }

    public function tutorFilter(Request $request){
        $cityId = $request->city;
        $districtId = $request->district;
        $subjectId = $request->subject;
        $tutorGender = $request->tutor_gender;
        $typeOfTutor = $request->type_of_tutor;

        $query = DB::table('tutor_subject')
            ->join('subjects', 'tutor_subject.subject_id', '=', 'subjects.id')
            ->join('specialities', 'subjects.speciality_id', '=', 'specialities.id')
            ->join('tutors','tutor_subject.tutor_id', '=', 'tutors.id')
            ->join('users','tutors.user_id', '=', 'users.id')
            ->join('districts', 'users.district_id', '=', 'districts.id')
            ->join('cities', 'users.city_id', '=', 'cities.id')
            ->select('tutors.id');

        if (!empty($districtId)){
            $this->districtName = District::find($districtId)->name;
            $query->where('districts.id','=', $districtId);
        }
        if (!empty($cityId)){
            $this->cityName = City::find($cityId)->name;
            $query->where('cities.id','=', $cityId);
        }
        if (!empty($subjectId)){
            $this->subjectName = Subject::find($subjectId)->name;
            $query->where('subjects.id','=', $subjectId);
        }

        if (!empty($tutorGender)){
            $tutorGender = $this->checkGender($tutorGender);
            if ($tutorGender !== self::BOTH_GENDER ){
                $query->where('users.gender','=', $tutorGender);
            }
        }
        if (!empty($typeOfTutor)){
            $typeOfTutor = $this->checkTypeOfTutor($typeOfTutor);
            if ($typeOfTutor !== self::BOTH_TYPE ){
                $query->where('tutors.type_of_tutor','=', $typeOfTutor);
            }
        }

        $userIds = $query->get()->unique()->toArray();
        $tutors = [];
        foreach ($userIds as $id){
            $tutors[] = Tutor::find($id->id);
        }
        $count = count($tutors);

        $filterString = $this->getFilterString();
//        dd($filterString);

        $specialities = Speciality::all();
        $cities = \App\City::all();
        $districts = \App\District::all();
        return view('search', compact('tutors', 'specialities', 'cities', 'districts', 'count', 'filterString'));

    }

    function getFilterString(){
        $filterString = 'Gia sư';
        if (!empty($this->tutorType)){
            $filterString .= ' là ' . $this->tutorType;
        }
        if (!empty($this->genderName)){
            $filterString .= ' ' . $this->genderName;
        }
        if (!empty($this->subjectName)){
            $filterString .= ', dạy môn ' . $this->subjectName;
        }
        if (!empty($this->districtName)){
            $filterString .= ' ở ' . $this->districtName;
        }
        if (!empty($this->districtName) && !empty($this->cityName)){
            $filterString .= ' ' . $this->cityName;
        }
        if (empty($this->districtName) && !empty($this->cityName)){
            $filterString .= ' ở ' . $this->cityName;
        }
        return $filterString;
    }

    protected function checkGender($gender){
        if ( $gender && count($gender) === 2 ){
            $this->genderName = "nam, nữ";
            return self::BOTH_GENDER;
        } else {
            if ( array_key_exists('male',$gender)){
                $this->genderName = "nam";
                return self::MALE;
            } else if ( array_key_exists('female',$gender)){
                $this->genderName = "nữ";
                return self::FEMALE;
            }
        }
    }
    protected function checkTypeOfTutor($type){
        if ( $type && count($type) === 2 ){
            $this->tutorType = "sinh viên, giáo viên";
            return self::BOTH_TYPE;
        } else {
            if ( array_key_exists('student',$type)){
                $this->tutorType = "sinh viên";
                return self::STUDENT;
            } else if ( array_key_exists('teacher',$type)){
                $this->tutorType = "giáo viên";
                return self::TEACHER;
            }
        }
    }
}
