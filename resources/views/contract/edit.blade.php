@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> العقود</h3>
                    <h3 class="card-title float-sm-left">
                        @can('cases-create')
                            <a class="btn btn-success" href="{{ route('contract.create') }}">إضافة</a>
                        @endcan
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info card-tabs">
                                <div class="card-body">
                                    <h5>بيانات العقد</h5>
                                    <!-- form start -->
                                    <div class="card card-primary">
                                        <!-- form start -->
                                        <form role="form" action="{{ route('contract.update',$row->id) }}"
                                            method="post" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">تاريخ العقد </label>
                                                            <input type="text" value="dd-mm-YYYY" name="contract_date"
                                                                autocomplete="off"
                                                                class="form-control txt-rtl hijri-date-default" placeholder="{{date('Y/m/d', strtotime($row->contract_date))}}" id="">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">نوع العقد</label>

                                                            <select class="custom-select" name="type_id">
                                                                <option>اختر</option>
                                                                @foreach ($types as $type)
                                                                    <option
                                                                        {{ $row->type_id  == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->type }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">اضافة ملفات مرفقة</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="attatchment"
                                                                    class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile">إختار
                                                                    ملف</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group contact">
                                                            <label for=""> التمهيد</label>
                                                            <textarea  class="form-control content" name="intro"
                                                                rows="3">{{$row->intro}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group contact">
                                                            <label for="">بنود العقد</label>
                                                            <textarea class="form-control content" name="contract_items"
                                                                rows="3">{{$row->contract_items}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->


                                        <hr />
                                        <h5 class="ml-2">بيانات الطرف الأول </h5>
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">اسم الطرف الأول</label>
                                                            <input type="text" name="{{$row->firstSide->name?? ''}}" class="form-control" name="first_name"
                                                                id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الجنسية</label>
                                                            <select class="custom-select" name="first_nationality_id">
                                                                @foreach ($nationalities as $type)
                                                                    <option
                                                                        {{$row->firstSide && $row->firstSide->nationality_id == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الهوية</label>
                                                            <input type="text" value="{{$row->firstSide->identity_no?? ''}}"
                                                                name="first_identity_no" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">نوع الهوية</label>

                                                            <select class="custom-select" name="first_identity_type_id">
                                                                <option value="0"
                                                                {{ $row->firstSide && $row->firstSide->identity_type_id == 0 ? 'selected' : '' }}>
                                                                هويه وطنية</option>
                                                            <option value="1"
                                                                {{ $row->firstSide && $row->firstSide->identity_type_id == 1 ? 'selected' : '' }}>
                                                                هوية مقيم</option>

                                                                <option value="2"
                                                                {{ $row->firstSide && $row->firstSide->identity_type_id == 2 ? 'selected' : '' }}>
                                                                جواز سفر</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">تاريخ الميلاد</label>
                                                            <input type="text" autocomplete="off"
                                                            @if ($row->firstSide) value="{{ date('Y/m/d', strtotime($row->firstSide->birth_date)) }}" @endif
                                                                name="first_birth_date"
                                                                class="form-control txt-rtl hijri-date-default" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">المدينة</label>
                                                            <select class="custom-select" name="first_city_id">
                                                                @foreach ($cities as $type)
                                                                    <option
                                                                        {{$row->firstSide &&  $row->firstSide->city_id == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الجوال</label>
                                                            <input type="text" name="first_mobile"
                                                                value="{{ $row->firstSide->mobile ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">فاكس</label>
                                                            <input type="text" value="{{ $row->firstSide->fax ?? '' }}"
                                                                name="first_fax" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">هاتف</label>
                                                            <input type="text" value="{{ $row->firstSide->phone ?? '' }}"
                                                                name="first_phone" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الوظيفة</label>
                                                            <input type="text" value="{{ $row->firstSide->job ?? '' }}"
                                                                name="first_job" class="form-control" id="">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">العنوان</label>
                                                            <input type="text" value="{{ $row->firstSide->address ?? '' }}"
                                                                name="first_address" class="form-control" id="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                        <hr />
                                        <h5 class="ml-2">بيانات الطرف الثانى</h5>
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">اسم الطرف الأول</label>
                                                            <input type="text" class="form-control" value="{{ $row->secondSide->name ?? '' }}" name="second_name"
                                                                id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الجنسية</label>
                                                            <select class="custom-select" name="second_nationality_id">
                                                                @foreach ($nationalities as $type)
                                                                    <option
                                                                        {{$row->secondSide && $row->secondSide->nationality_id == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الهوية</label>
                                                            <input type="text" value="{{$row->secondSide->identity_no?? ''}}"
                                                                name="first_identity_no" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">نوع الهوية</label>

                                                            <select class="custom-select" name="second_identity_type_id">
                                                                <option value="0"
                                                                {{ $row->secondSide && $row->secondSide->identity_type_id == 0 ? 'selected' : '' }}>
                                                                هويه وطنية</option>
                                                            <option value="1"
                                                                {{ $row->secondSide && $row->secondSide->identity_type_id == 1 ? 'selected' : '' }}>
                                                                هوية مقيم</option>

                                                                <option value="2"
                                                                {{ $row->secondSide && $row->secondSide->identity_type_id == 2 ? 'selected' : '' }}>
                                                                جواز سفر</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">تاريخ الميلاد</label>
                                                            <input type="text" autocomplete="off"
                                                            @if ($row->secondSide) value="{{ date('Y/m/d', strtotime($row->secondSide->birth_date)) }}" @endif
                                                                name="second_birth_date"
                                                                class="form-control txt-rtl hijri-date-default" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">المدينة</label>
                                                            <select class="custom-select" name="second_city_id">
                                                                @foreach ($cities as $type)
                                                                    <option
                                                                        {{ $row->secondSide && $row->secondSide->city_id == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الجوال</label>
                                                            <input type="text" name="second_mobile"
                                                                value="{{ $row->firstSide->mobile ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">فاكس</label>
                                                            <input type="text" value="{{ $row->secondSide->fax ?? '' }}"
                                                                name="second_fax" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">هاتف</label>
                                                            <input type="text" value="{{ $row->secondSide->phone ?? '' }}"
                                                                name="second_phone" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الوظيفة</label>
                                                            <input type="text" value="{{ $row->secondSide->job ?? '' }}"
                                                                name="second_job" class="form-control" id="">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">العنوان</label>
                                                            <input type="text" value="{{ $row->secondSide->address ?? '' }}"
                                                                name="second_address" class="form-control" id="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">حفظ </button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.col -->
    @endsection
