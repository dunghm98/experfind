<?php

namespace App\Http\Controllers;

use App\City;
use App\District;
use App\Http\Requests\RequestRequest;
use App\Speciality;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    private $districtName;
    private $cityName;
    private $subjectName;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('view', auth()->user()->student);
        $specialities = \App\Speciality::all();
        $cities = \App\City::all();
        return view('request-tutor', compact('specialities','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestRequest $request
     * @param \App\Request $requestForTutor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RequestRequest $request, \App\Request $requestForTutor)
    {
        $data = $request->all();
        /** @var Student $student */
        $student = auth()->user()->student;
        /** @var \App\Request $requestForTutor */
        if ($data['learning_method'] == 1){
            $request = $student->createRequest([
                'short_description' => $data['short_description'],
                'description' => $data['description'],
                'subject_id' => $data['subject'],
                'expect_fee' => $data['expect_fee'],
                'number_of_hour' => $data['number_of_hour'],
                'learning_method' => $data['learning_method'],
                'tutor_gender' => $data['tutor_gender'],
                'type_of_tutor' => $data['type_of_tutor'],
                'city_id' => $data['city'],
                'district_id' => $data['district'],
                'address' => $data['address']
            ]);
        } else if ($data['learning_method'] == 2){
                $request = $student->createRequest([
                'short_description' => $data['short_description'],
                'description' => $data['description'],
                'subject_id' => $data['subject'],
                'expect_fee' => $data['expect_fee'],
                'number_of_hour' => $data['number_of_hour'],
                'learning_method' => $data['learning_method'],
                'tutor_gender' => $data['tutor_gender'],
                'type_of_tutor' => $data['type_of_tutor'],
            ]);
        }
        $schedule = $data['schedule'];
        $scheduleData = [];
        foreach ($schedule as $key => $c){
            $scheduleData[$key] = $this->arrayToString($c);
        }
        $request->schedule()->create($scheduleData);
        return redirect(route('request.detail',$request->id));

    }

    public function arrayToString($data)
    {
         return implode(',', $data);
    }

    public function listRequest(\App\Request $requestTutor)
    {
        $requests = \App\Request::all();
        $specialities = Speciality::all();
        $cities = \App\City::all();
        $districts = \App\District::all();
        return view('list-request-tutor', compact('requests', 'specialities', 'cities', 'districts'));
    }

    public function filterRequest(Request $request)
    {
        $cityId = $request->city;
        $districtId = $request->district;
        $subjectId = $request->subject;

        $query = DB::table('requests')
            ->join('subjects', 'requests.subject_id', '=', 'subjects.id')
            ->join('specialities', 'subjects.speciality_id', '=', 'specialities.id')
            ->join('students','requests.student_id', '=', 'students.id')
            ->join('users','students.user_id', '=', 'users.id')
            ->join('districts', 'users.district_id', '=', 'districts.id')
            ->join('cities', 'users.city_id', '=', 'cities.id')
            ->select('requests.id');

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
        $requestIds = $query->get()->unique('id')->toArray();
        $requests = [];
        foreach ($requestIds as $id){
            $requests[] = \App\Request::find($id->id);
        }
        $count = count($requests);

        $filterString = $this->getFilterString();

        $specialities = Speciality::all();
        $cities = \App\City::all();
        $districts = \App\District::all();
        return view('list-request-tutor', compact('requests', 'specialities', 'cities', 'districts', 'filterString', 'count'));
    }

    public function listRequestByTag(Request $request)
    {
        $tag = $request->tag;
        $filterString = '';
        $query = DB::table('requests')
            ->select('requests.id');

        if (!empty($tag)){
            $filterString = str_replace('+', ' ', $tag);
            $query->where('requests.short_description','like', '%' . $tag .  '%')
                ->orWhere('requests.description','like', '%' . $tag .  '%');
        }
        $requestIds = $query->get()->unique('id')->toArray();
        $requests = [];
        foreach ($requestIds as $id){
            $requests[] = \App\Request::find($id->id);
        }
        $count = count($requests);

        $specialities = Speciality::all();
        $cities = \App\City::all();
        $districts = \App\District::all();
        return view('list-request-tutor', compact('requests', 'specialities', 'cities', 'districts', 'filterString', 'count'));
    }

    function getFilterString(){
        $filterString = 'Lớp học';
        if (!empty($this->subjectName)){
            $filterString .= ' môn ' . $this->subjectName;
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

    public function showRequest(\App\Request $request)
    {
        return view('detail-request-tutor', compact('request'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
