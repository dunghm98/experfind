<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Student;
use App\Tutor;
use App\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    const STUDENT = 0;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return void
     */
    public function show(Student $student)
    {
//        dd($student);
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
     * @param StudentRequest $request
     * @param User $user
     * @return void
     */
    public function update(StudentRequest $request, User $user)
    {
        $data = $request->all();
//        dd($data);
        $studentQuery = $user->student();
        /** @var Student $tutor */
        $student = $user->student;

        $studentInfo = [
        ];

        $userInfo = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'dob' =>  format_date($request->input('dob')),
            'city_id' => $request->input('city'),
            'district_id' => $request->input('district'),
            'address' => $request->input('address')
        ];

        if ($request->has('avatar')) {
            $avatarPath = $request->avatar->store('tutors/avatars', 'public');
            $userInfo['avatar'] = $avatarPath;
        }

        $student->updateUserInfo($userInfo);
        $studentQuery->update($studentInfo);

        return back();
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

    public function mainDashboard()
    {
        $this->authorize('view', auth()->user()->student);

        $student = auth()->user()->student;
//        dd($student);
        return view('student.main', compact('student'));
    }
    public function getProfile()
    {
        $this->authorize('view', auth()->user()->student);
        $cities = \App\City::all()->pluck('name','id');
        $student = auth()->user();
        return view('student.profile',compact('student','cities'));
    }


    public function getListRequest()
    {

        try {
            $userId = \request('id');
            $user = \App\User::find($userId);
            $student = $user->student;
            $requests = $student->requests;
            return request()->ajax() ?
                response()->json([
                    'status' => 200,
                    'requests' => $requests,
                    'message' => 'get thanh cong.'
                ]) :
                'get thanh cong';
        }catch (\Exception $e){
            return request()->ajax() ?
                response()->json([
                    'status' => 400,
                    'message' => $e->getMessage()
                ]) :
                $e->getMessage();
        }
    }


    public function viewProfile(Student $student)
    {
        return view('profiles.student',compact('student'));
    }

    public function bookTutor()
    {
        /** @var Tutor $tutor */
        /** @var \App\Request $request */
        try {
            $request = \App\Request::find(\request('requestId'));
            $tutor = \App\Tutor::find(\request('tutorId'));
            foreach ($request->tutors as $tutorApply){
                if (intval($tutorApply->id) == intval($tutor->id)){
                    return request()->ajax() ?
                        response()->json([
                            'status' => 500,
                            'message' => 'Bạn đã mời gia sư này trước đó hoặc người này đã gửi lời mời cho bạn rồi'
                        ]) :
                        'Bạn đã mời gia sư này trước đó hoặc người này đã gửi lời mời cho bạn rồi';
                }
            }
            $request->addTutor(\request('tutorId'),self::STUDENT);
            return request()->ajax() ?
                response()->json([
                    'status' => 200,
                    'message' => 'Gửi yêu cầu mời dạy thành công.'
                ]) :
                'Gửi yêu cầu mời dạy thành công.';
        } catch (\Exception $e){
            return request()->ajax() ?
                response()->json([
                    'status' => 400,
                    'message' => $e->getMessage()
                ]) :
                $e->getMessage();
        }

    }


    public function acceptRequest()
    {
        try {
            /** @var \App\Request $request */
            $request = \App\Request::find(\request('request'));
            $result = $request->acceptTutorRequest(\request('tutor'));
            if (!$result){
                return request()->ajax() ?
                    response()->json([
                        'status' => 500,
                        'message' => 'Yêu cầu này đã được accept trước đó rồi'
                    ]) :
                    'Yêu cầu này đã được accept trước đó rồi';
            }
            return request()->ajax() ?
                response()->json([
                    'status' => 200,
                    'message' => 'Xác nhận gia sư thành công.'
                ]) :
                'Xác nhận gia sư thành công.';
        } catch (\Exception $e){
            return request()->ajax() ?
                response()->json([
                    'status' => 400,
                    'message' => $e->getMessage()
                ]) :
                $e->getMessage();
        }
    }
}
