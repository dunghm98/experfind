@extends('admin.layouts.app')

@section('admin-content')


    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <!-- <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Lộ trình</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Lộ trình</li>
                        </ul>
                    </div>
                </div>
            </div> -->
            <!-- /Page Header -->
            <form action="{{ route('saveSubject') }}" method="post">
                @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tên môn học</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="{{ $subject->id }}" name="id">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Môn học</label>
                                    <div class="col-md-10">
                                        <input value="{{ old('name', $subject->name) }}" name="name" type="text" class="form-control">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            <div class="form-group row">
                                <label for="collection" class="col-form-label col-md-2">Chuyên môn</label>
                                <div class="col-md-10">
                                    <select id="speciality_id" name="speciality_id" class="form-control col-md-5 select" >
                                        <option value="">Lựa chọn...</option>
                                        @foreach($specialities as $speciality)
                                            <option {{ $speciality->id == $subject->speciality_id ? 'selected' : '' }} value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="form-group row" style="margin-left: 0% !important;">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>
    <!-- /Main Wrapper -->



    @endsection
