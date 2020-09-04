<?php

namespace App\Http\Controllers;

use App\City;
use App\District;
use App\Speciality;
use App\Student;
use App\Subject;
use App\Tutor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function showDashBoard()
    {
        $dataCount = [];
        $dataCount['collection'] = 1;
        $dataCount['course'] = 3;
        $dataCount['lesson'] = 2;
        $dataCount['user'] = 3;
        return view('admin.dashboard', compact('dataCount'));
    }

    public function showCities()
    {
        $cities = City::all();
        return view('admin.list.city', compact('cities'));
    }

    public function editCity(City $city)
    {
        return view('admin.edit.city', compact('city'));
    }

    public function saveCity(Request $request)
    {
        $name = $request->validate([
            'name' => 'required'
        ]);
        $city = \App\City::find($request->id);
        $city->name = $name['name'];
        $city->save();
        return redirect(route('showCities'));
    }

    public function createCity()
    {
        return view('admin.add.city');
    }
    public function storeCity(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $city = \App\City::create($data);
        return redirect(route('showCities'));
    }

    public function deleteCity(City $city)
    {
        $city = \App\City::destroy($city->id);
        return redirect(route('showCities'));
    }


//    District
    public function showDistricts()
    {
        $districts = District::all();
        return view('admin.list.district', compact('districts'));
    }

    public function editDistrict(District $district)
    {
        $cities = City::all();
        return view('admin.edit.district', compact('district', 'cities'));
    }

    public function saveDistrict(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'city_id' => 'required'
        ]);
        $district = \App\District::find($request->id);
        $district->name = $data['name'];
        $district->city_id = $data['city_id'];
        $district->save();
        return redirect(route('showDistricts'));
    }

    public function createDistrict()
    {
        $cities = City::all();
        return view('admin.add.district',compact('cities'));
    }
    public function storeDistrict(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'city_id' => 'required'
        ]);
        $city = \App\District::create($data);
        return redirect(route('showDistricts'));
    }

    public function deleteDistrict(District $district)
    {
        $city = \App\District::destroy($district->id);
        return redirect(route('showDistricts'));
    }




    public function showSpecialities()
    {
        $specialities= Speciality::all();
        return view('admin.list.speciality', compact('specialities'));
    }

    public function editSpeciality(Speciality $speciality)
    {
        return view('admin.edit.speciality', compact('speciality'));
    }

    public function saveSpeciality(Request $request)
    {
        $name = $request->validate([
            'name' => 'required'
        ]);
        $speciality = \App\Speciality::find($request->id);
        $speciality->name = $name['name'];
        $speciality->save();
        return redirect(route('showSpecialities'));
    }

    public function createSpeciality()
    {
        return view('admin.add.speciality');
    }
    public function storeSpeciality(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $speciality = \App\Speciality::create($data);
        return redirect(route('showSpecialities'));
    }

    public function deleteSpeciality(Speciality $speciality)
    {
        $speciality = \App\Speciality::destroy($speciality->id);
        return redirect(route('showSpecialities'));
    }


//    District
    public function showSubjects()
    {
        $subjects = Subject::all();
        return view('admin.list.subject', compact('subjects'));
    }

    public function editSubject(Subject $subject)
    {
        $specialities = Speciality::all();
        return view('admin.edit.subject', compact('subject', 'specialities'));
    }

    public function saveSubject(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'speciality_id' => 'required'
        ]);
        $subject = \App\Subject::find($request->id);
        $subject->name = $data['name'];
        $subject->speciality_id = $data['speciality_id'];
        $subject->save();

        return redirect(route('showSubjects'));
    }

    public function createSubject()
    {
        $specialities = Speciality::all();
        return view('admin.add.subject',compact('specialities'));
    }
    public function storeSubject(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'speciality_id' => 'required'
        ]);
        $subject = \App\Subject::create($data);
        return redirect(route('showSubjects'));
    }

    public function deleteSubject(Subject $subject)
    {
        $subject = \App\Subject::destroy($subject->id);
        return redirect(route('showSubjects'));
    }


//    Tutor
    public function showTutors()
    {
        $tutors = Tutor::all();
        return view('admin.list.tutor', compact('tutors'));
    }

    public function viewTutor(Tutor $tutor)
    {
        return view('admin.view.tutor', compact('tutor'));
    }

    public function deleteTutor(Tutor $tutor)
    {
        $tutor = \App\Tutor::destroy($tutor->id);
        return redirect(route('showTutors'));
    }
//    student
    public function showStudents()
    {
        $students = Student::all();
        return view('admin.list.student', compact('students'));
    }

    public function viewStudent(Student $student)
    {
        return view('admin.view.student', compact('student'));
    }

    public function deleteStudent(Student $student)
    {
        $student = \App\Student::destroy($student->id);
        return redirect(route('showTutors'));
    }
}
