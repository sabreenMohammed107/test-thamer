@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">عرض بيانات العميل</h3>
                <h3 class="card-title float-sm-left">

                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <form role="form">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">اسم العميل</label>
                                    <input type="text"
                                        class="form-control" value="{{$row->name ?? ''}}" name="name" id="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">الجنسية</label>
                                    <input type="text"
                                    class="form-control" value="{{$row->nationality->name ?? ''}}" name="nationality_id" id="">


                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">رقم الهوية</label>
                                    <input type="text"
                                        class="form-control" value="{{ $row->identity_no ?? '' }}" name="identity_no" id="">
                                </div>
                            </div>
                            {{-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">نوع الهوية</label>
                                    <select class="custom-select" name="identity_type_id">
                                        <option value="0"
                                            {{ $row->oppon && $row->identity_type_id == 0 ? 'selected' : '' }}>
                                            Passport</option>
                                        <option value="1"
                                            {{ $row->oppon && $row->identity_type_id == 1 ? 'selected' : '' }}>
                                            ID</option>

                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">تاريخ الميلاد</label>
                                    <input type="text" value="{{date('Y/m/d', strtotime($row->birth_date))}}"
                                        name="birth_date" class="form-control txt-rtl hijri-date-default"
                                        id="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">المدينة</label>
                                    <input type="text"
                                    class="form-control" value="{{$row->city->name ?? ''}}" name="city_id" id="">


                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">رقم الجوال</label>
                                    <input type="text"
                                        class="form-control" value="{{ $row->mobile ??'' }}" name="mobile" id="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">البريد الالكتروني</label>
                                    <input type="text"
                                        class="form-control" value="{{ $row->email??'' }}" name="email" id="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">فاكس</label>
                                    <input type="text"
                                        class="form-control" value="{{ $row->fax ?? ''}}" name="fax" id="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">هاتف</label>
                                    <input type="text"
                                        class="form-control" value="{{ $row->phone ?? ''}}" name="phone" id="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">الوظيفة</label>
                                    <input type="text"
                                        class="form-control" value="{{ $row->job ?? ''}}" name="job" id="">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">العنوان</label>
                                    <input type="text"
                                        class="form-control" value="{{ $row->address ?? ''}}" name="address" id="">
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {{-- <button type="submit" class="btn btn-primary">رجوع</button> --}}
                        <a href="{{ route('client') }}"
                        class="btn btn-danger">إلغاء</a>
                    </div>
                </form>
            </div>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        @endsection
