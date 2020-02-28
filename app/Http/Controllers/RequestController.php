<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRequest;
use App\Student;
use Illuminate\Http\Request;

class RequestController extends Controller
{
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

        $request = $student->createRequest([
            'short_description' => $data['short_description'],
            'description' => $data['description'],
            'subject_id' => $data['subject'],
            'expect_fee' => $data['expect_fee'],
            'number_of_hour' => $data['number_of_hour'],
            'learning_method' => $data['learning_method'],
            'tutor_gender' => $data['tutor_gender'],
            'type_of_tutor' => $data['type_of_tutor']
        ]);
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
        return view('list-request-tutor', compact('requests'));
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
