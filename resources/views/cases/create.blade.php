@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> القضايا</h3>

                </div>
                <!-- /.card-header -->

                {{-- <div class="card-body"> --}}
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">

                                <i class="fas fa-edit"></i> إضافه قضية
                                <?php
                                $case = 0;
                                if (Session::get('case_id')) {
                                    $case = Session::get('case_id');
                                }
                                ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-info card-tabs">
                                        <div class="card-header p-0 pt-1 bg-white">
                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-tabs-one-1-tab" data-toggle="pill"
                                                        href="#custom-tabs-one-1" role="tab"
                                                        aria-controls="custom-tabs-one-1" aria-selected="true">بيانات
                                                        اساسية</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-2-tab" data-toggle="pill"
                                                        href="#custom-tabs-one-2" role="tab"
                                                        aria-controls="custom-tabs-one-2" aria-selected="false">العميل </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-3-tab" data-toggle="pill"
                                                        href="#custom-tabs-one-3" role="tab"
                                                        aria-controls="custom-tabs-one-3" aria-selected="false">الخصم</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-one-1"
                                                    role="tabpanel" aria-labelledby="custom-tabs-one-1-tab">
                                                    <div class="card card-primary">
                                                        <!-- form start -->
                                                        <form role="form" action="{{ route('cases.store') }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">تاريخ بدايه القضيه </label>
                                                                            <span style="color: red">*</span>
                                                                            <input type="text" value="dd-mm-YYYY"
                                                                                name="start_date" autocomplete="off"
                                                                                class="form-control txt-rtl hijri-date-default"
                                                                                id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">رقم الملف</label>
                                                                            <input type="text"
                                                                                value="{{ old('file_no') }}"
                                                                                name="file_no" class="form-control" id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for=""> القضيه</label>
                                                                            <span style="color: red">*</span>
                                                                            <input type="text" value="{{ old('name') }}"
                                                                                name="name" class="form-control" id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">الفرع
                                                                                <span style="color: red">*</span>
                                                                            </label>

                                                                            <select class="custom-select dynamic"
                                                                                name="branch_id" id="branch_id">
                                                                                <option>اختر </option>

                                                                                @foreach ($branches as $type)
                                                                                    <option
                                                                                        {{ old('type_id') == $type->id ? 'selected' : '' }}
                                                                                        value="{{ $type->id }}">
                                                                                        {{ $type->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for=""> المكلف
                                                                                <span style="color: red">*</span>
                                                                            </label>

                                                                            <select class="custom-select   dynamix"
                                                                                name="current_resposible_id" id="users">
                                                                                <option>اختر </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">المحكمه</label>
                                                                            <select class="custom-select" id="court_id"
                                                                                name="court_id">
                                                                                @foreach ($courts as $type)
                                                                                    <option
                                                                                        {{ old('court_id') == $type->id ? 'selected' : '' }}
                                                                                        value="{{ $type->id }}">
                                                                                        {{ $type->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">رقم القضيه في المحكمه</label>
                                                                            <input type="text"
                                                                                value="{{ old('court_case_no') }}"
                                                                                name="court_case_no" class="form-control"
                                                                                id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">الصفه القانونيه للعميل</label>
                                                                            <input type="text"
                                                                                value="{{ old('client_low_description') }}"
                                                                                name="client_low_description"
                                                                                class="form-control" id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">نوع القضيه</label>
                                                                            <select class="custom-select" id="case_type_id"
                                                                                name="case_type_id">
                                                                                @foreach ($caseTypes as $type)
                                                                                    <option
                                                                                        {{ old('case_type_id') == $type->id ? 'selected' : '' }}
                                                                                        value="{{ $type->id }}">
                                                                                        {{ $type->type }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">رقم الشكوي في الشرطه</label>
                                                                            <input type="text"
                                                                                value="{{ old('police_escalation_no') }}"
                                                                                name="police_escalation_no"
                                                                                class="form-control" id="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">رقم القضيه في النيابة
                                                                                العامة</label>
                                                                            <input type="text"
                                                                                value="{{ old('public_prosecutor_case_no') }}"
                                                                                name="public_prosecutor_case_no"
                                                                                class="form-control" id="">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">الدائره</label>
                                                                            <input type="text"
                                                                                value="{{ old('circle_no') }}"
                                                                                name="circle_no" class="form-control"
                                                                                id="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">اسم الخبير </label>
                                                                            <input type="text"
                                                                                value="{{ old('expert_name') }}"
                                                                                name="expert_name" class="form-control"
                                                                                id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">الوصف</label>
                                                                            <textarea class="form-control" name="notes" rows="3">{{ old('notes') }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">رقم قرار التنفيذ </label>
                                                                            <input type="text"
                                                                                value="{{ old('exec_dision_no') }}"
                                                                                name="exec_dision_no" class="form-control"
                                                                                id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">رقم سند التنفيذ </label>
                                                                            <input type="text"
                                                                                value="{{ old('exec_Deed_no') }}"
                                                                                name="exec_dision_no" class="form-control"
                                                                                id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">تاريخ سند التنفيذ </label>
                                                                            <input type="text" value="dd-mm-YYYY"
                                                                                name="exec_Deed_date" autocomplete="off"
                                                                                class="form-control txt-rtl hijri-date-default"
                                                                                id="">
                                                                        </div>
                                                                    </div>
                                                                    @hasrole('Admin')
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="">قيمه الاتعاب</label>
                                                                                <input type="text"
                                                                                    value="{{ old('case_fees') }}"
                                                                                    name="case_fees" class="form-control"
                                                                                    id="">
                                                                            </div>
                                                                        </div>
                                                                    @endhasrole
                                                                    @hasrole('Admin')
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="">نوع الاتعاب</label>
                                                                                <select class="custom-select" id="fees_type"
                                                                                    name="fees_type">
                                                                                    <option
                                                                                        {{ old('fees_type') == 0 ? 'selected' : '' }}
                                                                                        value="0">دفعات</option>
                                                                                    <option
                                                                                        {{ old('fees_type') == 1 ? 'selected' : '' }}
                                                                                        value="1"> نسب</option>
                                                                                    <option
                                                                                        {{ old('fees_type') == 2 ? 'selected' : '' }}
                                                                                        value="1"> دفعة واحدة</option>

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    @endhasrole

                                                                </div>
                                                            </div>
                                                            <!-- /.card-body -->
                                                            <div class="card-footer">
                                                                <button type="submit" class="btn btn-primary">حفظ</button>
                                                                <a href="{{ route('cases.index') }}"
                                                                    class="btn btn-danger">إلغاء</a>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            {{-- </div> --}}
                                            <div class="tab-pane fade" id="custom-tabs-one-2" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-2-tab">
                                                <form action="{{ route('attach-client') }}" id="form-id" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <input type="hidden" name="case_id" value="{{ $case }}">

                                                        <div class="col-md-7">
                                                            <div class="row">
                                                                <div class="col-md-7">
                                                                    <div class="form-group">
                                                                        <label>رقم هوية العميل </label><a
                                                                            href="cases-projects-create.html"
                                                                            data-toggle="modal" data-target="#add-client">
                                                                            إضافة عميل جديد</a>
                                                                        <select class="form-control select2"
                                                                            style="width: 100%;" name="client_id"
                                                                            id="client_id">
                                                                            <option>اختر</option>
                                                                            @foreach ($clients as $type)
                                                                                <option
                                                                                    {{ old('client_id') == $type->id ? 'selected' : '' }}
                                                                                    value="{{ $type->id }}">
                                                                                    {{ $type->name }} /
                                                                                    {{ $type->identity_no }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- /.form-group -->
                                                                </div>
                                                                <div class="col-md-5 mt-2">
                                                                    <br />
                                                                    <a href="#" class="btn btn-success" data-toggle="modal"
                                                                        data-target="#add-tab-client"> ربط العميل
                                                                        بالقضية</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- form start -->

                                                    </div>
                                                    <!--save Company-->
                                                    <div id="add-tab-client"
                                                        class="modal modal-edu-general fullwidth-popup-InformationproModal fade"
                                                        role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header header-color-modal bg-color-2">
                                                                    <p class="modal-title" style="text-align:right">حفظ
                                                                        البيانات</p>
                                                                    <div class="modal-close-area modal-close-df">
                                                                        <a class="close" data-dismiss="modal"
                                                                            href="#"><i class="fa fa-close"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <span
                                                                        class="educate-icon educate-danger modal-check-pro information-icon-pro">
                                                                    </span>

                                                                    <p>هل تريد ربط العميل بالقضيه ؟ </p>
                                                                </div>
                                                                <div class="modal-footer info-md">
                                                                    <a data-dismiss="modal" href="#">إلغــاء</a>

                                                                    <button
                                                                        class="btn btn-primary waves-effect waves-light"
                                                                        name="action" value="save"
                                                                        onclick="document.getElementById('form-id').submit();">حفظ</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/save Company-->
                                                </form>
                                                <hr />
                                                <div id="accordion">
                                                    <div class="card">
                                                        <div class="card-header bg-dark2" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link text-white"
                                                                    data-toggle="collapse" data-target="#collapseOne"
                                                                    aria-expanded="true" aria-controls="collapseOne">
                                                                    عرض بيانات العميل
                                                                </button>
                                                            </h5>
                                                        </div>

                                                        <div id="collapseOne" class="collapse"
                                                            aria-labelledby="headingOne" data-parent="#accordion">
                                                            @include('cases.preClient')
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="tab-pane fade" id="custom-tabs-one-3" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-3-tab">
                                                <form action="{{ route('attach-opponent') }}" id="form-id2
                                                        " method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <input type="hidden" name="case_id" value="{{ $case }}">

                                                        <div class="col-md-7">

                                                            <div class="row">
                                                                <div class="col-md-7">
                                                                    <div class="form-group">
                                                                        <label>رقم هوية الخصم</label><a
                                                                            href="cases-projects-create.html"
                                                                            data-toggle="modal"
                                                                            data-target="#add-adversaries"> إضافة خصم
                                                                            جديد</a>
                                                                        <select class="form-control select2"
                                                                            style="width: 100%;" id="oppont_id"
                                                                            name="opponent_id">
                                                                            <option>اختر</option>

                                                                            @foreach ($oppenonts as $type)
                                                                                <option
                                                                                    {{ old('opponent_id') == $type->id ? 'selected' : '' }}
                                                                                    value="{{ $type->id }}">
                                                                                    {{ $type->name }} /
                                                                                    {{ $type->identity_no }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- /.form-group -->
                                                                </div>
                                                                <div class="col-md-5 mt-2">
                                                                    <br />
                                                                    <a href="#" class="btn btn-success" data-toggle="modal"
                                                                        data-target="#add-tab-oppon"> ربط الخصم
                                                                        بالقضية</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- form start -->

                                                    </div>
                                                    <!--save Company-->
                                                    <div id="add-tab-oppon"
                                                        class="modal modal-edu-general fullwidth-popup-InformationproModal fade"
                                                        role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header header-color-modal bg-color-2">
                                                                    <p class="modal-title" style="text-align:right">حفظ
                                                                        البيانات</p>
                                                                    <div class="modal-close-area modal-close-df">
                                                                        <a class="close" data-dismiss="modal"
                                                                            href="#"><i class="fa fa-close"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <span
                                                                        class="educate-icon educate-danger modal-check-pro information-icon-pro">
                                                                    </span>

                                                                    <p>هل تريد ربط الخصم بالقضيه ؟ </p>
                                                                </div>
                                                                <div class="modal-footer info-md">
                                                                    <a data-dismiss="modal" href="#">إلغــاء</a>

                                                                    <button
                                                                        class="btn btn-primary waves-effect waves-light"
                                                                        name="action" value="save"
                                                                        onclick="document.getElementById('form-id2').submit();">حفظ</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/save Company-->
                                                </form>
                                                <hr />
                                                <div id="accordion">
                                                    <div class="card">
                                                        <div class="card-header bg-dark2" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link text-white"
                                                                    data-toggle="collapse" data-target="#collapseTwo"
                                                                    aria-expanded="true" aria-controls="collapseTwo">
                                                                    عرض بيانات الخصم
                                                                </button>
                                                            </h5>
                                                        </div>

                                                        <div id="collapseTwo" class="collapse"
                                                            aria-labelledby="headingOne" data-parent="#accordion">
                                                            @include('cases.preOppon')


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
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

            <!-- Add Client Modal -->
            <div class="modal fade dir-rtl" id="add-client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة بيانات عميل </h5>
                            <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h3><i class="fas fa-edit text-success"></i></h3>
                            <form role="form" action="{{ route('add-client') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">

                                        <input type="hidden" name="case_id" value="{{ $case }}">


                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">اسم العميل</label>
                                                <input type="text" value="{{ old('name') }}" name="name"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">الجنسية</label>
                                                <select class="custom-select" name="nationality_id">
                                                    @foreach ($nationalities as $type)
                                                        <option
                                                            {{ old('nationality_id') == $type->id ? 'selected' : '' }}
                                                            value="{{ $type->id }}">
                                                            {{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">رقم الهوية</label>
                                                <input type="text" value="{{ old('identity_no') }}" name="identity_no"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">نوع الهوية</label>
                                                <select class="custom-select" name="identity_type_id">
                                                    <option value="0"
                                                        {{ old('identity_type_id') == 0 ? 'selected' : '' }}>
                                                        هويه وطنية</option>
                                                    <option value="1"
                                                        {{ old('identity_type_id') == 1 ? 'selected' : '' }}>
                                                        هوية مقيم</option>
                                                    <option value="2"
                                                        {{ old('identity_type_id') == 2 ? 'selected' : '' }}>
                                                        جواز سفر</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">تاريخ الميلاد</label>
                                                <input type="text" autocomplete="off"
                                                    value="{{ old('birth_date', date('d-m-Y')) }}" name="birth_date"
                                                    class="form-control txt-rtl hijri-date-default" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">المدينة</label>
                                                <select class="custom-select" name="city_id">
                                                    @foreach ($cities as $type)
                                                        <option {{ old('city_id') == $type->id ? 'selected' : '' }}
                                                            value="{{ $type->id }}">
                                                            {{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">رقم الجوال</label>
                                                <input type="text" value="{{ old('mobile') }}" name="mobile"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">البريد الالكتروني</label>
                                                <input type="text" value="{{ old('email') }}" name="email"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">فاكس</label>
                                                <input type="text" value="{{ old('fax') }}" name="fax"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">هاتف</label>
                                                <input type="text" value="{{ old('phone') }}" name="phone"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">الوظيفة</label>
                                                <input type="text" value="{{ old('job') }}" name="job"
                                                    class="form-control" id="">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">العنوان</label>
                                                <input type="text" value="{{ old('address') }}" name="address"
                                                    class="form-control" id="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="modal-footer">
                                    <a href="{{ route('cases.index') }}" class="btn btn-secondary">إلغاء</a>
                                    <button type="submit" class="btn btn-danger">تأكيد</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Add Adversaries Modal -->
            <div class="modal fade dir-rtl" id="add-adversaries" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة بيانات خصم</h5>
                            <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h3><i class="fas fa-edit text-success"></i></h3>
                            <form role="form" action="{{ route('add-opponent') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="case_id" value="{{ $case }}">


                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">اسم الخصم</label>
                                                <input type="text" value="{{ old('name') }}" name="name"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">الجنسية</label>
                                                <select class="custom-select" name="nationality_id">
                                                    @foreach ($nationalities as $type)
                                                        <option
                                                            {{ old('nationality_id') == $type->id ? 'selected' : '' }}
                                                            value="{{ $type->id }}">
                                                            {{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">رقم الهوية</label>
                                                <input type="text" value="{{ old('identity_no') }}" name="identity_no"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">نوع الهوية</label>
                                                <select class="custom-select" name="identity_type_id">
                                                    <option value="0"
                                                        {{ old('identity_type_id') == 0 ? 'selected' : '' }}>
                                                        هويه وطنية</option>
                                                    <option value="1"
                                                        {{ old('identity_type_id') == 1 ? 'selected' : '' }}>
                                                        هوية مقيم</option>
                                                    <option value="2"
                                                        {{ old('identity_type_id') == 2 ? 'selected' : '' }}>
                                                        جواز سفر</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">تاريخ الميلاد</label>
                                                <input type="text" autocomplete="off"
                                                    value="{{ old('birth_date', date('Y/m/d')) }}" name="birth_date"
                                                    class="form-control txt-rtl hijri-date-default" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">المدينة</label>
                                                <select class="custom-select" name="city_id">
                                                    @foreach ($cities as $type)
                                                        <option {{ old('city_id') == $type->id ? 'selected' : '' }}
                                                            value="{{ $type->id }}">
                                                            {{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">رقم الجوال</label>
                                                <input type="text" value="{{ old('mobile') }}" name="mobile"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">البريد الالكتروني</label>
                                                <input type="text" value="{{ old('email') }}" name="email"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">فاكس</label>
                                                <input type="text" value="{{ old('fax') }}" name="fax"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">هاتف</label>
                                                <input type="text" value="{{ old('phone') }}" name="phone"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">الوظيفة</label>
                                                <input type="text" value="{{ old('job') }}" name="job"
                                                    class="form-control" id="">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">العنوان</label>
                                                <input type="text" value="{{ old('address') }}" name="address"
                                                    class="form-control" id="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="modal-footer">
                                    {{-- <a href="{{route('cases.show', $row->id) }}" class="btn btn-secondary">إلغاء</a> --}}
                                    <button type="submit" class="btn btn-danger">تأكيد</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        @endsection

        @section('scripts')

            <script>
                $(document).ready(function() {
                    $('#client_id').select2();
                    $('#oppont_id').select2();
                    $('.dynamic').change(function() {

                        // if ($(this).val() != '') {
                        var value = $(this).val();

                        $.ajax({
                            url: "{{ route('dynamicBranch.fetch') }}",
                            method: "get",
                            data: {
                                value: value,
                            },
                            success: function(result) {

                                $('#users').html(result);
                            }

                        })
                        // }
                    });
                    // end dynamic
                    $('#client_id').change(function() {
                        var latest_value = $("option:selected:first", this).val();
                        $.ajax({
                            url: "{{ route('editClient.search') }}",

                            method: "get",
                            data: {

                                client: latest_value,

                            },
                            success: function(result) {
                                $('#collapseOne').html(result);


                            }
                        });

                    });
                    //upon
                    $('#oppont_id').change(function() {
                        var latest_value = $("option:selected:first", this).val();
                        $.ajax({
                            url: "{{ route('editOpponent.search') }}",

                            method: "get",
                            data: {

                                client: latest_value,

                            },
                            success: function(result) {
                                $('#collapseOne').html(result);


                            }
                        });

                    });

                });
                // end ready
                //client data
            </script>
        @endsection
