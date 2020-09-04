@extends('layouts.app')
@section('bottom.js')
    <script src="{{ asset('js/dialog-box.js') }}"></script>
    <script src="{{ asset('js/tag-search.js') }}"></script>
@endsection

@section('content')
    @include('homepage.banner')
    @include('homepage.speciality')
    @include('homepage.popular-tutor')
    @include('homepage.speciality-category')
    @include('homepage.new-class')

@endsection



@section('call-modal')
    <!-- Book tutor Modal -->
    <div class="modal fade call-modal" id="book-tutor">
        <div class="modal-dialog booking-modal modal-dialog-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div student-data="{{auth()->user()->id ?? 0}}" class="card modal-content" id="booking-modal">
                        <div class="card-header d-inline-flex justify-content-between">
                            <h4 class="card-title d-inline-block mr-2">Book Gia Sư:</h4>
                            <div>
                                <span class="avatar avatar-sm">
                                    <img id="tutor-book-img" class="avatar-img rounded-circle" alt="User Image" src="">
                                </span>
                                <h5 tutor-data="" id="tutor-book-name" class="d-inline-block">Hoang Manh Dung</h5>
                            </div>
                        </div>
                        <div id="message-box"></div>
                        <div id="choose-request">
                            <h5 class="mt-3 mb-1">Chọn yêu cầu học mà bạn muốn mời giáo viên này dạy</h5>
                            <div class="card-body border">
                                <div class="mt-3 request-cont">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right"><a href="javascript:void(0);" class="btn btn-secondary btn-exit" data-dismiss="modal" aria-label="Close">Thoát</a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Booking Modal -->

@endsection
@section('booking-modal-css')
    <style rel="stylesheet" type="text/css">

        .modal.fade .modal-dialog.booking-modal {
            transition: transform 0.1s ease-out !important;
            transform: translate(0, -50px);
        }
        .modal-backdrop.show {
            opacity: 0.4;
            -webkit-transition-duration: 100ms !important;
            transition-duration: 100ms !important;
        }
    </style>
    @endsection
