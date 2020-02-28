<?php

namespace App\Http\Controllers;

use App\Authentication;
use App\Http\Requests\TutorRequest;
use App\Request;
use App\Speciality;
use App\Tutor;
use App\User;
use Illuminate\Support\Facades\Validator;

class TutorController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    const TUTOR =  1;
    const ACCEPT_REQUEST = 3;
    public function index()
    {
        /** @var User $tutors */
        $tutors = \App\Tutor::all();
        return view('search', compact('tutors'));
    }

    public function showProfile()
    {
        $this->middleware('auth');
        $cities = \App\City::all()->pluck('name','id');
        /** @var Tutor $tutor */
        $tutor = auth()->user()->tutor;
        $specialities = $tutor->getSpecialities();
        return view('tutor.profile', compact('tutor', 'specialities','cities'));
    }

    public function updateProfile(TutorRequest $request, Tutor $tutor)
    {
        /** @var Tutor $tutor */

        $educations = $request->input('educations');
        $experiences = $request->input('experiences');
        $certificates = $request->input('certificates');
        $tutorInfo = [
            'type_of_tutor' => $request->input('type_of_tutor'),
            'introduction' => $request->input('introduction'),
            'tag' => $request->input('tag'),
            'tuition_fee' => $request->input('tuition_fee')
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

        $tutor->updateUserInfo($userInfo);
        $tutor->update($tutorInfo);
        $tutor->setSubject(request('subject_name') ?? []);
        $tutor->createEducations($educations);
        $tutor->createExperiences($experiences);
        $tutor->createCertificates($certificates);

        return back();
    }


    public function updateAuthInfo()
    {
        /** @var Authentication $authImage */
        $authImage = Authentication::find(request('id'));
        try {
            if ($authImage) {
                if (request()->has('img')) {
                    $imgPath = request('img')->store('tutors/auth-info', 'public');

                    $authImage->update([
                        'name' => request('name') ?? null,
                        'img' => $imgPath
                    ]);
                    return request()->ajax() ?
                        response()->json([
                            'status' => 200,
                            'message' => 'Thêm ảnh thành công.'
                        ]) :
                        'Thêm ảnh thành công.';
                }
                throw new \Exception('Something went wrong');
            }
        } catch (\Exception $e) {
            return request()->ajax() ?
                response()->json([
                    'status' => 400,
                    'message' => $e->getMessage()
                ]) :
                $e->getMessage();
        }
    }

    public function deleteAuthInfo(Authentication $auth)
    {
        try {
            $auth->delete();
            return request()->ajax() ?
                response()->json([
                    'status' => 200,
                    'message' => 'Xóa ảnh thành công.'
                ]) :
                'Xóa ảnh thành công';
        } catch (\Exception $e) {
            return request()->ajax() ?
                response()->json([
                    'status' => 400,
                    'message' => $e->getMessage()
                ]) :
                $e->getMessage();
        }
    }

    public function createAuthInfo(Tutor $tutor)
    {

        try {
            $validator = Validator::make(
                ['name' => request('name')],
                [
                    'name' => 'required'
                ],
                [
                    'name.required' => 'Tên loại giấy tờ không được để trống'
                ],
                [
                    'name' => 'Name'
                ]
            );
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->errors()
                ]);
            }
            if (request()->has('img')) {


                $imgPath = request('img')->store('tutors/auth-info', 'public');
                 $tutor->authentications()->create([
                    'name' => request('name') ?? null,
                    'img' => $imgPath
                ]);

                return request()->ajax() ?
                    response()->json([
                        'status' => 200,
                        'message' => 'Cập nhật ảnh thành công.'
                    ]) :
                    'Cập nhật ảnh thành công.';
            }
        } catch (\Exception $e){
            return request()->ajax() ?
                response()->json([
                    'status' => 400,
                    'message' => $e->getMessage()
                ]) :
                $e->getMessage();
        }
    }

    public function viewTutorProfile(Tutor $tutor)
    {
        return view('profiles.tutor', compact('tutor'));
    }

    public function searchBySpeciality(Speciality $speciality)
    {
        $tutors = collect();
        $subjects = $speciality->subjects;
        foreach ($subjects as $subject){
            $tutors = $tutors->merge($subject->tutors);
        }
        $tutors = $tutors->unique();
        return view('search', compact('tutors','speciality'));
    }

    public function askForTeach()
    {
        /** @var Tutor $tutor */
        try {
            $request = \App\Request::find(\request('request'));
            $tutor = \App\Tutor::find(\request('tutor'));
            foreach ($request->tutors as $tutorApply){
                if (intval($tutorApply->id) == intval($tutor->id)){
                    return request()->ajax() ?
                        response()->json([
                            'status' => 500,
                            'message' => 'Bạn đã apply rồi mà'
                        ]) :
                    'Bạn đã apply rồi mà';
                }
            }
            $tutor->createRequest(\request('request'), self::TUTOR);
            $numberApplier = $request->tutors()->count();
            return request()->ajax() ?
                response()->json([
                    'status' => 200,
                    'number_apply' => $numberApplier,
                    'message' => 'Gửi yêu cầu dạy thành công.'
                ]) :
                'Gửi yêu cầu dạy thành công.';
        } catch (\Exception $e){
            return request()->ajax() ?
                response()->json([
                    'status' => 400,
                    'message' => $e->getMessage()
                ]) :
                $e->getMessage();
        }
    }

    public function mainDashboard()
    {
        if (auth()->user()->can('view', auth()->user()->tutor)) {
            $tutor = auth()->user()->tutor;
            return view('tutor.main',compact('tutor'));
        }
        return redirect(route('student.dashboard'));
    }

    public function acceptRequest()
    {
        try {
            /** @var Tutor $tutor */
            $tutor = \App\Tutor::find(\request('tutor'));
            $result = $tutor->acceptRequest(\request('request'));
            if (!$result){
                return request()->ajax() ?
                    response()->json([
                        'status' => 500,
                        'message' => 'Yêu cầu này đã được ai đó accept trước đó rồi'
                    ]) :
                    'Yêu cầu này đã được ai đó accept trước đó rồi';
            }
            return request()->ajax() ?
                response()->json([
                    'status' => 200,
                    'message' => 'Xác nhận dạy lớp thành công.'
                ]) :
                'Gửi yêu cầu dạy thành công.';
        } catch (\Exception $e){
            return request()->ajax() ?
                response()->json([
                    'status' => 400,
                    'message' => $e->getMessage()
                ]) :
                $e->getMessage();
        }
    }

    public function declineRequest()
    {
        try {
            /** @var Tutor $tutor */
            $tutor = \App\Tutor::find(\request('tutor'));
            $result = $tutor->declineRequest(\request('request'));
            if (!$result){
                return request()->ajax() ?
                    response()->json([
                        'status' => 500,
                        'message' => 'Bạn đã hủy yêu cầu này rồi mà'
                    ]) :
                    'Bạn đã hủy yêu cầu này rồi mà';
            }
            return request()->ajax() ?
                response()->json([
                    'status' => 200,
                    'message' => 'hủy yêu cầu thành công.'
                ]) :
                'hủy yêu cầu thành công.';
        } catch (\Exception $e){
            return request()->ajax() ?
                response()->json([
                    'status' => 400,
                    'message' => $e->getMessage()
                ]) :
                $e->getMessage();
        }
    }

    public function listAppointment()
    {
        $tutor = auth()->user()->tutor;
        return view('tutor.appointment',compact('tutor'));
    }

    public function deleteRequest()
    {
        try {
            /** @var Tutor $tutor */
            $tutor = \App\Tutor::find(\request('tutor'));
            $tutor->deleteRequest(\request('request'));
            return request()->ajax() ?
                response()->json([
                    'status' => 200,
                    'message' => 'Xóa yêu cầu thành công.'
                ]) :
                'Xóa yêu cầu thành công';
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
