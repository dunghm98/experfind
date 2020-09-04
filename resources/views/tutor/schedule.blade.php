@extends('tutor.dashboard')
@section('dashboard-content')

    <div class="col-md-7 col-lg-8 col-xl-9">
        <form action="{{ route('tutor.updateSchedule') }}" method="post" id="form" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thời gian có thể dạy của bạn</h4>
                            <br>
                            <div class="row form-row justify-content-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="weekday-calendar schedule">
                                            <div class="day-of-week mon">
                                                <button type="button" value="mon" class="btn btn-secondary">Thứ 2</button>
                                                <ul class="custom-checkbox">
                                                    <li>
                                                        <input name="schedule[mon][]" type="checkbox" id="morning-2" value="morning"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('mon','morning')==true ? 'checked' : ''}}>
                                                        <label for="morning-2">Sáng</label>
                                                    </li>
                                                    <li>
                                                        <input name="schedule[mon][]" type="checkbox" id="afternoon-2" value="afternoon"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('mon','afternoon')==true ? 'checked' : ''}}>
                                                        <label for="afternoon-2">Chiều</label></li>
                                                    <li>
                                                        <input name="schedule[mon][]" type="checkbox" id="evening-2" value="evening"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('mon','evening')==true ? 'checked' : ''}}>
                                                        <label for="evening-2">Tối</label></li>
                                                </ul>
                                            </div>
                                            <div class="day-of-week tue">
                                                <button type="button" value="tue" class="btn btn-secondary">Thứ 3</button>
                                                <ul class="custom-checkbox">
                                                    <li>
                                                        <input name="schedule[tue][]" type="checkbox" id="morning-3" value="morning"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('tue','morning')==true ? 'checked' : ''}}>
                                                        <label for="morning-3">Sáng</label></li>
                                                    <li>
                                                        <input name="schedule[tue][]" type="checkbox" id="afternoon-3" value="afternoon"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('tue','afternoon')==true ? 'checked' : ''}}>
                                                        <label for="afternoon-3">Chiều</label></li>
                                                    <li>
                                                        <input name="schedule[tue][]" type="checkbox" id="evening-3" value="evening"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('tue','evening')==true ? 'checked' : ''}}>
                                                        <label for="evening-3">Tối</label></li>
                                                </ul>
                                            </div>
                                            <div class="day-of-week wed">
                                                <button type="button" value="wed" class="btn btn-secondary">Thứ 4</button>
                                                <ul class="custom-checkbox">
                                                    <li>
                                                        <input name="schedule[wed][]" type="checkbox" id="morning-4" value="morning"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('wed','morning')==true ? 'checked' : ''}}>
                                                        <label for="morning-4">Sáng</label></li>
                                                    <li>
                                                        <input name="schedule[wed][]" type="checkbox" id="afternoon-4" value="afternoon"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('wed','afternoon')==true ? 'checked' : ''}}>
                                                        <label for="afternoon-4">Chiều</label></li>
                                                    <li>
                                                        <input name="schedule[wed][]" type="checkbox" id="evening-4" value="evening"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('wed','evening')==true ? 'checked' : ''}}>
                                                        <label for="evening-4">Tối</label></li>
                                                </ul>
                                            </div>
                                            <div class="day-of-week thur">
                                                <button type="button" value="thur" class="btn btn-secondary">Thứ 5</button>
                                                <ul class="custom-checkbox">
                                                    <li>
                                                        <input name="schedule[thur][]" type="checkbox" id="morning-5" value="morning"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('thur','morning')==true ? 'checked' : ''}}>
                                                        <label for="morning-5">Sáng</label></li>
                                                    <li>
                                                        <input name="schedule[thur][]" type="checkbox" id="afternoon-5" value="afternoon"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('thur','afternoon')==true ? 'checked' : ''}}>
                                                        <label for="afternoon-5">Chiều</label></li>
                                                    <li>
                                                        <input name="schedule[thur][]" type="checkbox" id="evening-5" value="evening"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('thur','evening')==true ? 'checked' : ''}}>
                                                        <label for="evening-5">Tối</label></li>
                                                </ul>
                                            </div>
                                            <div class="day-of-week fri">
                                                <button type="button" value="fri" class="btn btn-secondary">Thứ 6</button>
                                                <ul class="custom-checkbox">
                                                    <li>
                                                        <input name="schedule[fri][]" type="checkbox" id="morning-6" value="morning"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('fri','morning')==true ? 'checked' : ''}}>
                                                        <label for="morning-6">Sáng</label></li>
                                                    <li>
                                                        <input name="schedule[fri][]" type="checkbox" id="afternoon-6" value="afternoon"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('fri','afternoon')==true ? 'checked' : ''}}>
                                                        <label for="afternoon-6">Chiều</label></li>
                                                    <li>
                                                        <input name="schedule[fri][]" type="checkbox" id="evening-6" value="evening"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('fri','evening')==true ? 'checked' : ''}}>
                                                        <label for="evening-6">Tối</label></li>
                                                </ul>
                                            </div>
                                            <div class="day-of-week sat">
                                                <button type="button" value="sat" class="btn btn-secondary">Thứ 7</button>
                                                <ul class="custom-checkbox">
                                                    <li>
                                                        <input name="schedule[sat][]" type="checkbox" id="morning-7" value="morning"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('sat','morning')==true ? 'checked' : ''}}>
                                                        <label for="morning-7">Sáng</label></li>
                                                    <li>
                                                        <input name="schedule[sat][]" type="checkbox" id="afternoon-7" value="afternoon"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('sat','afternoon')==true ? 'checked' : ''}}>
                                                        <label for="afternoon-7">Chiều</label></li>
                                                    <li>
                                                        <input name="schedule[sat][]" type="checkbox" id="evening-7" value="evening"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('sat','evening')==true ? 'checked' : ''}}>
                                                        <label for="evening-7">Tối</label></li>
                                                </ul>
                                            </div>
                                            <div class="day-of-week sun">
                                                <button type="button" value="sun" class="btn btn-secondary">Chủ Nhật</button>
                                                <ul class="custom-checkbox">
                                                    <li>
                                                        <input name="schedule[sun][]" type="checkbox" id="morning-8" value="morning"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('sun','morning')==true ? 'checked' : ''}}>
                                                        <label for="morning-8">Sáng</label></li>
                                                    <li>
                                                        <input name="schedule[sun][]" type="checkbox" id="afternoon-8" value="afternoon"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('sun','afternoon')==true ? 'checked' : ''}}>
                                                        <label for="afternoon-8">Chiều</label></li>
                                                    <li>
                                                        <input name="schedule[sun][]" type="checkbox" id="evening-8" value="evening"
                                                            {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('sun','evening')==true ? 'checked' : ''}}>
                                                        <label for="evening-8">Tối</label></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <i class="js-errors" style="display: none"></i>
                                    </div>

                                </div>
                                @error('schedule')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="submit-section submit-btn-bottom">
                                <button type="submit" class="btn btn-primary submit-btn">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
