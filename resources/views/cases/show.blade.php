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
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i> إضافه قضية
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-info card-tabs">
                                        <div class="card-header p-0 pt-1 bg-white">
                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-10-tab" data-toggle="pill" href="#custom-tabs-one-10" role="tab" aria-controls="custom-tabs-one-10" aria-selected="false"> اجراءات القضيه </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-tabs-one-1-tab" data-toggle="pill" href="#custom-tabs-one-1" role="tab" aria-controls="custom-tabs-one-1" aria-selected="true">ملف القضية</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-2-tab" data-toggle="pill" href="#custom-tabs-one-2" role="tab" aria-controls="custom-tabs-one-2" aria-selected="false">فريق العمل</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-3-tab" data-toggle="pill" href="#custom-tabs-one-3" role="tab" aria-controls="custom-tabs-one-3" aria-selected="false">لوائح اعتراضية</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-4-tab" data-toggle="pill" href="#custom-tabs-one-4" role="tab" aria-controls="custom-tabs-one-4" aria-selected="false">مذكرات </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-5-tab" data-toggle="pill" href="#custom-tabs-one-5" role="tab" aria-controls="custom-tabs-one-5" aria-selected="false">خطابات </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-9-tab" data-toggle="pill" href="#custom-tabs-one-9" role="tab" aria-controls="custom-tabs-one-9" aria-selected="false">التماس إعاده النظر </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-6-tab" data-toggle="pill" href="#custom-tabs-one-6" role="tab" aria-controls="custom-tabs-one-6" aria-selected="false">جلسات </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-7-tab" data-toggle="pill" href="#custom-tabs-one-7" role="tab" aria-controls="custom-tabs-one-7" aria-selected="false">المرفقات </a>
                                                </li>
                                                @hasrole('Admin')
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-8-tab" data-toggle="pill" href="#custom-tabs-one-8" role="tab" aria-controls="custom-tabs-one-8" aria-selected="false"> دفعات الأتعاب</a>
                                                </li>
                                                @endhasrole

                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-one-1" role="tabpanel" aria-labelledby="custom-tabs-one-1-tab">
                                                    <div class="card card-primary">
                                                        <!-- form start -->
                                                        <form role="form">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">تاريخ بدايه القضيه </label>
                                                                            <input type="text" autocomplete="off" value="{{date('Y/m/d', strtotime($case->start_date))}}"
                                                                            name="start_date" placeholder="{{date('Y/m/d', strtotime($case->start_date))}}" class="form-control txt-rtl hijri-date-default"
                                                                            id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">رقم الملف</label>
                                                                            <input type="text"  value="{{ $case->file_no }}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">اسم القضيه</label>
                                                                            <input type="text" value="{{ $case->name }}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">المحكمه</label>
                                                                            <select class="custom-select" id="court_id"
                                                                                name="court_id">
                                                                                @foreach ($courts as $type)
                                                                                    <option
                                                                                        {{ $case->court_id == $type->id ? 'selected' : '' }}
                                                                                        value="{{ $type->id }}">
                                                                                        {{ $type->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">رقم قرار التنفيذ </label>
                                                                            <input type="text"  value="{{ $case->exec_dision_no }}" class="form-control" id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">الفرع</label>
                                                                            <select class="custom-select dynamic"
                                                                            name="branch_id" id="branch_id">
                                                                            <option>اختر </option>

                                                                            @foreach ($branches as $type)
                                                                                <option
                                                                                    {{ $case->branch_id == $type->id ? 'selected' : '' }}
                                                                                    value="{{ $type->id }}">
                                                                                    {{ $type->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">رقم القضيه في المحكمه</label>
                                                                            <input type="text"  value="{{$case->court_case_no }}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">الصفه القانونيه للعميل</label>
                                                                            <input type="text"  value="{{ $case->client_low_description}}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">نوع القضيه</label>
                                                                            <select class="custom-select" id="case_type_id"
                                                                                name="case_type_id">
                                                                                @foreach ($caseTypes as $type)
                                                                                    <option
                                                                                        {{ $case->case_type_id == $type->id ? 'selected' : '' }}
                                                                                        value="{{ $type->id }}">
                                                                                        {{ $type->type }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    @hasrole('Admin')
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">نوع الاتعاب</label>
                                                                            <select class="custom-select" id="fees_type"
                                                                                name="fees_type">
                                                                                <option
                                                                                    {{ $case->fees_type == 0 ? 'selected' : '' }}
                                                                                    value="0">كاش</option>
                                                                                <option
                                                                                    {{ $case->fees_type == 1 ? 'selected' : '' }}
                                                                                    value="1"> قسط</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    @endhasrole
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">رقم الشكوي في الشرطه</label>
                                                                            <input type="text"  value="{{ $case->police_escalation_no }}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    @hasrole('Admin')
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">قيمه الاتعاب</label>
                                                                            <input type="text"
                                                                                value="{{ $case->case_fees }}" readonly
                                                                                name="case_fees" class="form-control"
                                                                                id="">
                                                                        </div>
                                                                    </div>
                                                                @endhasrole
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">رقم القضيه في النيابة العامة</label>
                                                                            <input type="text"  value="{{ $case->public_prosecutor_case_no }}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">الدائره</label>
                                                                            <input type="text" value="{{ $case->circle_no}}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">اسم الخبير </label>
                                                                            <input type="text"   value="{{ $case->expert_name }}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3"></div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">الوصف</label>
                                                                            <textarea class="form-control" rows="3" disabled>{{ $case->notes }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.card-body -->

                                                        </form>
                                                        <hr />
                                                        <h5 class="ml-2">بيانات العميل </h5>
                                                        <form role="form">
                                                            <div class="card-body">
                                                                <div class="row">


                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">اسم العميل</label>
                                                                            <input type="text" value="{{$case->client->name ?? ''}}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">الجنسية</label>
                                                                            <select class="custom-select" name="nationality_id" disabled>
                                                                                @foreach ($nationalities as $type)
                                                                                    <option
                                                                                        {{ $case->client->nationality_id == $type->id ? 'selected' : '' }}
                                                                                        value="{{ $type->id }}">
                                                                                        {{ $type->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">رقم الهوية</label>
                                                                            <input type="text" value="{{ $case->client->identity_no ?? '' }}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">نوع الهوية</label>
                                                                            <select class="custom-select" name="identity_type_id" disabled>
                                                                                <option value="0"
                                                                                    {{ $case->oppon && $case->client->identity_type_id == 0 ? 'selected' : '' }}>
                                                                                    Passport</option>
                                                                                <option value="1"
                                                                                    {{ $case->oppon && $case->client->identity_type_id == 1 ? 'selected' : '' }}>
                                                                                    ID</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">تاريخ الميلاد</label>
                        <input type="text" autocomplete="off" readonly @if($case->oppon) value="{{date('Y/m/d', strtotime($case->client->birth_date))}}" @endif
                            name="birth_date" class="form-control txt-rtl hijri-date-default"
                            id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">المدينة</label>
                                                                            <select class="custom-select" name="city_id" disabled>
                                                                                @foreach ($cities as $type)
                                                                                    <option {{ $case->client->city_id == $type->id ? 'selected' : '' }}
                                                                                        value="{{ $type->id }}">
                                                                                        {{ $type->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">رقم الجوال</label>
                                                                            <input type="text"  value="{{ $case->client->mobile ??'' }}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">البريد الالكتروني</label>
                                                                            <input type="text" value="{{ $case->client->email??'' }}"  class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">فاكس</label>
                                                                            <input type="text" value="{{ $case->client->fax ?? ''}}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">هاتف</label>
                                                                            <input type="text" value="{{ $case->client->phone ?? ''}}"  class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">الوظيفة</label>
                                                                            <input type="text"value="{{ $case->client->job ?? ''}}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">العنوان</label>
                                                                            <input type="text" value="{{ $case->client->address ?? ''}}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- /.card-body -->
                                                        </form>
                                                        <hr />
                                                        <h5 class="ml-2">بيانات الخصم</h5>
                                                        <form role="form">
                                                            <div class="card-body">
                                                                <div class="row">

                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">اسم الخصم</label>
                                                                            <input type="text" value="{{$case->oppon->name  ?? ''}}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">رقم الهوية</label>
                                                                            <input type="text" value="{{ $case->oppon->identity_no  ?? ''}}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">الجنسية</label>
                                                                            <select class="custom-select" name="nationality_id" disabled>
                                                                                @foreach ($nationalities as $type)
                                                                                    <option
                                                                                        {{  $case->oppon->nationality_id == $type->id ? 'selected' : '' }}
                                                                                        value="{{ $type->id }}">
                                                                                        {{ $type->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">تاريخ الميلاد</label>
                                                                            <input type="text" autocomplete="off" @if($case->oppon) value="{{date('Y/m/d', strtotime($case->oppon->birth_date))}}" @endif
                                                                                name="birth_date" class="form-control txt-rtl hijri-date-default"
                                                                                id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">نوع الهوية</label>
                                                                            <select class="custom-select" name="identity_type_id" disabled>
                                                                                <option value="0"
                                                                                    {{$case->oppon && $case->oppon->identity_type_id == 0 ? 'selected' : '' }}>
                                                                                    Passport</option>
                                                                                <option value="1"
                                                                                    {{$case->oppon && $case->oppon->identity_type_id == 1 ? 'selected' : '' }}>
                                                                                    ID</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">العنوان</label>
                                                                            <input type="text" value="{{ $case->oppon->address ?? ''}}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">المدينة</label>
                                                                            <select class="custom-select" name="city_id" disabled>
                                                                                @foreach ($cities as $type)
                                                                                    <option {{ $case->oppon->city_id == $type->id ? 'selected' : '' }}
                                                                                        value="{{ $type->id }}">
                                                                                        {{ $type->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">رقم الجوال</label>
                                                                            <input type="text" value="{{ $case->oppon->mobile  ?? ''}}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">البريد الالكتروني</label>
                                                                            <input type="text" value="{{ $case->oppon->email ?? '' }}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">هاتف</label>
                                                                            <input type="text"  value="{{ $case->oppon->phone ?? '' }}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">فاكس</label>
                                                                            <input type="text" value="{{ $case->oppon->fax ?? '' }}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="">الوظيفة</label>
                                                                            <input type="text" value="{{ $case->oppon->job ?? '' }}" class="form-control" id="" disabled>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </form>

                                                        <div class="card-footer">

                                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#archive{{ $case->id }}">تحويل إلي الارشيف</button>
                                                        </div>
 <!-- archive Modal -->
 <div class="modal fade dir-rtl" id="archive{{ $case->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('archiveCase') }}" method="POST">
                @csrf
                <input type="hidden" name="case_id" value="{{ $case->id }}">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">تأكيد الأرشفة</h5>
                    <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h3><i class="fas fa-fire text-primary"></i></h3>
                    <h4>تأكيد تحويل القضية للارشيف</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-success">تأكيد</button>
                </div>
            </form>
        </div>
    </div>
</div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-2" role="tabpanel" aria-labelledby="custom-tabs-one-2-tab">
                                                    @include('cases.teamMember')
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-3" role="tabpanel" aria-labelledby="custom-tabs-one-3-tab">
                                                 @include('cases.regulations')
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-4" role="tabpanel" aria-labelledby="custom-tabs-one-4-tab">
                                                @include('cases.diary')
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-5" role="tabpanel" aria-labelledby="custom-tabs-one-5-tab">
                                                  @include('cases.letters')
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-6" role="tabpanel" aria-labelledby="custom-tabs-one-6-tab">
                                                 @include('cases.sessions')
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-7" role="tabpanel" aria-labelledby="custom-tabs-one-7-tab">
                                               @include('cases.attachment')
                                                </div>
                                                @hasrole('Admin')
                                                <div class="tab-pane fade" id="custom-tabs-one-8" role="tabpanel" aria-labelledby="custom-tabs-one-8-tab">
                                          @include('cases.fees')
                                                </div>
                                                @endhasrole
                                                <div class="tab-pane fade" id="custom-tabs-one-9" role="tabpanel" aria-labelledby="custom-tabs-one-9-tab">
                                               @include('cases.petiation')
                                                </div>
                                                <div class="tab-pane fade mb-3" id="custom-tabs-one-10" role="tabpanel" aria-labelledby="custom-tabs-one-10-tab">
                                                
                                                    <div class="btn-group">
                                                        <span><h6> إضافة إجراء </span>
                                                        <button type="button" class="btn btn-default btn-flat">
                                                            <i class="fas fa-list-ul"></i>
                                                            لوائح اعتراضية
                                                        </button>
                                                        <button type="button" class="btn btn-default btn-flat">
                                                            <i class="fas fa-list-ul"></i>
                                                            مذكرات
                                                        </button>
                                                        <button type="button" class="btn btn-default btn-flat">
                                                            <i class="fas fa-list-ul"></i>
                                                          خطابات
                                                        </button>
                                                        <button type="button" class="btn btn-default btn-flat">
                                                            <i class="fas fa-list-ul"></i>
                                                            التماس إعادة النظر
                                                          </button>
                                                          <button type="button" class="btn btn-default btn-flat">
                                                            <i class="fas fa-list-ul"></i>
                                                            جلسات
                                                          </button>
                                                          <button type="button" class="btn btn-default btn-flat">
                                                            <i class="fas fa-list-ul"></i>
                                                            المرفقات
                                                          </button>
                                                      </div>
{{-- ///////////////////////////////////////////////////////////////////////////////// --}}
                                                   <br>
                                                      <div class="btn-group-vertical">
                                                        <span class="mb-2"><b> <i class="fas fa-list-ul"></i> إضافة إجراء </b> </span>
                                                        <button type="button" class="btn btn-info text-right">
                                                            <i class="fas fa-check-square"></i>
                                                            لوائح اعتراضية
                                                        </button>
                                                        <button type="button" class="btn btn-info text-right">
                                                            <i class="fas fa-check-square"></i>
                                                            مذكرات
                                                        </button>
                                                        <button type="button" class="btn btn-info text-right">
                                                            <i class="fas fa-check-square"></i>
                                                            خطابات
                                                        </button>
                                                        <button type="button" class="btn btn-info text-right">
                                                            <i class="fas fa-check-square"></i>
                                                            التماس إعادة النظر
                                                        </button>
                                                        <button type="button" class="btn btn-info text-right">
                                                            <i class="fas fa-check-square"></i>
                                                            جلسات
                                                        </button>
                                                        <button type="button" class="btn btn-info text-right">
                                                            <i class="fas fa-check-square"></i>
                                                            المرفقات
                                                        </button>
                                                        <br>
                                                      </div>

                                                      <div class="btn-group-vertical">
                                                        <span class="mb-2"><b> <i class="fas fa-list-ul"></i> إضافة إجراء </b> </span>
                                                        <button type="button" class="btn btn-default text-right">
                                                            <i class="fas fa-check-circle"></i>
                                                            لوائح اعتراضية
                                                        </button>
                                                        <button type="button" class="btn btn-default text-right">
                                                            <i class="fas fa-check-circle"></i>
                                                            مذكرات
                                                        </button>
                                                        <button type="button" class="btn btn-default text-right">
                                                            <i class="fas fa-check-circle"></i>
                                                            خطابات
                                                        </button>
                                                        <button type="button" class="btn btn-default text-right">
                                                            <i class="fas fa-check-circle"></i>
                                                            التماس إعادة النظر
                                                        </button>
                                                        <button type="button" class="btn btn-default text-right">
                                                            <i class="fas fa-check-circle"></i>
                                                            جلسات
                                                        </button>
                                                        <button type="button" class="btn btn-default text-right">
                                                            <i class="fas fa-check-circle"></i>
                                                            المرفقات
                                                        </button>
                                                        <br>
                                                      </div>

                                                      <div class="btn-group">
                                                        <button type="button" class="btn btn-info"> إضافة إجراء </button>
                                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                          <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                          <a class="dropdown-item" href="#">لوائح اعتراضية</a>
                                                          <a class="dropdown-item" href="#">مذكرات</a>
                                                          <a class="dropdown-item" href="#">خطابات</a>
                                                          <a class="dropdown-item" href="#">التماس إعادة النظر</a>
                                                          <a class="dropdown-item" href="#">جلسات</a>
                                                          <a class="dropdown-item" href="#">المرفقات</a>
                                                        </div>
                                                      </div>

                                                      <div class="btn-group">
                                                        <button type="button" class="btn btn-default"> إضافة إجراء </button>
                                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                          <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                          <a class="dropdown-item" href="#">لوائح اعتراضية</a>
                                                          <a class="dropdown-item" href="#">مذكرات</a>
                                                          <a class="dropdown-item" href="#">خطابات</a>
                                                          <a class="dropdown-item" href="#">التماس إعادة النظر</a>
                                                          <a class="dropdown-item" href="#">جلسات</a>
                                                          <a class="dropdown-item" href="#">المرفقات</a>
                                                        </div>
                                                      </div>

                                                      <div class="card">
                                                        <div class="card-header">
                                                          <h3 class="card-title"> إضافة إجراء </h3>
                                                        </div>
                                                        <div class="card-body">
                                                          <a class="btn btn-app">
                                                            <i class="fas fa-edit"></i> لوائح اعتراضية
                                                          </a>
                                                          <a class="btn btn-app">
                                                            <i class="fas fa-list"></i> مذكرات
                                                          </a>
                                                          <a class="btn btn-app">
                                                            <i class="fas fa-envelope"></i> خطابات
                                                          </a>
                                                          <a class="btn btn-app">
                                                            <i class="fas fa-save"></i> التماس إعادة النظر
                                                          </a>
                                                          <a class="btn btn-app">
                                                            <i class="fas fa-bullhorn"></i> جلسات
                                                          </a>
                                                          <a class="btn btn-app">
                                                            <i class="fas fa-barcode"></i> المرفقات
                                                          </a>
                                                        </div>
                                                        <!-- /.card-body -->
                                                      </div>

                                @include('cases.presdure')
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

                @endsection

                @section('scripts')

                <script>
function test(){
    var attach = $('input[name="attach"]').val();


var link = document.createElement("a");
link.download = 'attach';
link.href = attach;
link.click();
}
//                     jQuery(document).ready(function() {
//  //dawnload files
//                         $('#downloadCurrent').click(function() {
//                             alert('link')
//                             var attach = $('input[name="attach"]').val();


//                             var link = document.createElement("a");
//                             link.download = 'attach';
//                             link.href = attach;
//                             link.click();
// alert(link)

//                         });

                    // });

   /*rich text*/
        /*rich text powerpaste*/
        $(document).ready(function() {

tinymce.init({
    selector: 'textarea.content',
    toolbar: 'undo redo | formatselect | ' +
        'bold italic forecolor backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat |forecolor backcolor',
    statusbar: false,
    plugins: [
        'textcolor', 'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount '
    ],

    menubar: false,
    init_instance_callback: "insert_contents",
    height: "480",
});
});
tinymce.init({
selector: 'textarea.content2',
toolbar: 'undo redo | formatselect | ' +
    'bold italic forecolor backcolor | alignleft aligncenter ' +
    'alignright alignjustify | bullist numlist outdent indent | ' +
    'removeformat |forecolor backcolor',
statusbar: false,
plugins: [
    'textcolor', 'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount '
],

menubar: false,
init_instance_callback: "insert_contents3",
height: "480",
});

tinymce.init({
selector: 'textarea.content3',
toolbar: 'undo redo | formatselect | ' +
    'bold italic forecolor backcolor | alignleft aligncenter ' +
    'alignright alignjustify | bullist numlist outdent indent | ' +
    'removeformat |forecolor backcolor',
statusbar: false,
plugins: [
    'textcolor', 'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount '
],

menubar: false,
init_instance_callback: "insert_contents3",
height: "480",
});


function insert_contents(inst) {
inst.setContent(
    `  <p dir="rtl"><h1 style="text-align: center;">مذكرة جوابية</h1>
<p style="text-align: right;">
    <b >/فضيلة </b> <p style="text-align: left;">سلمه الله</p>
</p>
<h3 style="text-align: center;">السلام عليكم و رحمة الله و بركاته</h3>
<p style="text-align: right;">
    <b >:إشارة إلى الدعوى </b>
</p></p>`);
}

                </script>

                @endsection
