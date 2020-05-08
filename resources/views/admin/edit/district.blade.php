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
            <form action="{{ route('saveDistrict') }}" method="post">
                @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tên quận huyện</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="{{ $district->id }}" name="id">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Quận huyện</label>
                                    <div class="col-md-10">
                                        <input value="{{ old('name', $district->name) }}" name="name" type="text" class="form-control">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            <div class="form-group row">
                                <label for="collection" class="col-form-label col-md-2">Thành Phố</label>
                                <div class="col-md-10">
                                    <select id="city_id" name="city_id" class="form-control col-md-5 select" >
                                        <option value="">Lựa chọn...</option>
                                        @foreach($cities as $city)
                                            <option {{ $city->id == $district->city_id ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
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
