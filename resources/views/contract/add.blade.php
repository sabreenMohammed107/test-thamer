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
                                        <form role="form" action="{{ route('contract.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">تاريخ العقد </label>
                                                            <input type="text" value="dd-mm-YYYY" name="contract_date"
                                                                autocomplete="off"
                                                                class="form-control txt-rtl hijri-date-default" id="">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">نوع العقد</label>

                                                            <select class="custom-select" name="type_id">
                                                                <option>اختر</option>
                                                                @foreach ($types as $type)
                                                                    <option
                                                                        {{ old('type_id') == $type->id ? 'selected' : '' }}
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
                                                            <textarea class="form-control content" name="intro"
                                                                rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group contact">
                                                            <label for="">بنود العقد</label>
                                                            <textarea class="form-control content" name="contract_items"
                                                                rows="3"></textarea>
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
                                                            <input type="text" class="form-control" name="first_name"
                                                                id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الجنسية</label>
                                                            <select class="custom-select" name="first_nationality_id">
                                                                @foreach ($nationalities as $type)
                                                                    <option
                                                                        {{ old('first_nationality_id') == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الهوية</label>
                                                            <input type="text" value="{{ old('first_identity_no') }}"
                                                                name="first_identity_no" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">نوع الهوية</label>
                                                            <select class="custom-select" name="first_identity_type_id">
                                                                <option value="0"
                                                                    {{ old('first_identity_type_id') == 0 ? 'selected' : '' }}>
                                                                    Passport</option>
                                                                <option value="1"
                                                                    {{ old('first_identity_type_id') == 1 ? 'selected' : '' }}>
                                                                    ID</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">تاريخ الميلاد</label>
                                                            <input type="text" autocomplete="off"
                                                                value="{{ old('first_birth_date', date('d-m-Y')) }}"
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
                                                                        {{ old('first_city_id') == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الجوال</label>
                                                            <input type="text" value="{{ old('first_email') }}"
                                                                name="first_email" class="form-control" id="">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">فاكس</label>
                                                            <input type="text" value="{{ old('first_fax') }}"
                                                                name="first_fax" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">هاتف</label>
                                                            <input type="text" value="{{ old('first_phone') }}"
                                                                name="first_phone" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الوظيفة</label>
                                                            <input type="text" value="{{ old('first_job') }}"
                                                                name="first_job" class="form-control" id="">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">العنوان</label>
                                                            <input type="text" value="{{ old('first_address') }}"
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
                                                            <input type="text" class="form-control" name="second_name"
                                                                id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الجنسية</label>
                                                            <select class="custom-select" name="second_nationality_id">
                                                                @foreach ($nationalities as $type)
                                                                    <option
                                                                        {{ old('second_nationality_id') == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الهوية</label>
                                                            <input type="text" value="{{ old('second_identity_no') }}"
                                                                name="second_identity_no" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">نوع الهوية</label>
                                                            <select class="custom-select" name="second_identity_type_id">
                                                                <option value="0"
                                                                    {{ old('second_identity_type_id') == 0 ? 'selected' : '' }}>
                                                                    Passport</option>
                                                                <option value="1"
                                                                    {{ old('second_identity_type_id') == 1 ? 'selected' : '' }}>
                                                                    ID</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">تاريخ الميلاد</label>
                                                            <input type="text" autocomplete="off"
                                                                value="{{ old('second_birth_date', date('d-m-Y')) }}"
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
                                                                        {{ old('second_city_id') == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الجوال</label>
                                                            <input type="text" value="{{ old('second_email') }}"
                                                                name="second_email" class="form-control" id="">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">فاكس</label>
                                                            <input type="text" value="{{ old('second_fax') }}"
                                                                name="second_fax" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">هاتف</label>
                                                            <input type="text" value="{{ old('second_phone') }}"
                                                                name="second_phone" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الوظيفة</label>
                                                            <input type="text" value="{{ old('second_job') }}"
                                                                name="second_job" class="form-control" id="">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">العنوان</label>
                                                            <input type="text" value="{{ old('second_address') }}"
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
