<h3 class="card-title float-sm-left">
</h3>
<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th> نوع الإجراء</th>
            <th>التاريخ - الوقت</th>
            <th>المكلف</th>
            <th>الحالة </th>
            {{-- <th>إنجاز </th> --}}
            <th>ملاحظات</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($presdures as $index => $row)
            <tr>
                <th>{{ $index + 1 }}</th>
                <th> {{ $row->type->type ?? '' }}</th>
                {{-- <th>{{ date('Y/m/d', strtotime($row->task_date)) }} </th> --}}
                <th>{{ $row->task_date }} </th>
                <th>
                    @if ($row->task_type_id == 7)
                        {{ $row->transfer->name ?? '' }}
                    @else
                        {{ $row->member->name ?? '' }}
                    @endif
                </th>
                <th>
                    <div class="btn-group">
                        @if ($row->task_status_id == 1)
                            منجز
                            {{-- <i class="fas fa-check"></i> --}}
                        @else
                            <button type="button" @if ($row && $row->task_status_id == 1) disabled @endif
                                class="btn btn-default" data-toggle="modal" data-target="#doneProced{{ $row->id }}">
                                قيد الإجراء</button>

                            {{-- <i class="fas fa-times"></i> --}}
                        @endif
                    </div>
                </th>
                {{-- <th>
                    <div class="btn-group">
                        <button type="button" @if ($row && $row->task_status_id == 1) disabled @endif class="btn btn-default"
                            data-toggle="modal" data-target="#doneProced{{ $row->id }}">
                            <i class="fas fa-check"
                                title="view"></i></button>
                    </div>
                </th> --}}
                <th>
                    @if ($row->regulation_id)
                        {{ $row->regulation->notes }}
                    @endif
                </th>
                <th>
                    <div class="btn-group">
                        @can('cases-list')
                            <a href="{{ route('presdure.show', $row->id) }}" class="btn btn-default"><i
                                    class="fas fa-eye" title="view"></i></a>
                        @endcan
                        @can('cases-edit')
                            <a href="{{ route('presdure.edit', $row->id) }}" class="btn btn-default"><i
                                    class="fas fa-edit" title="edit"></i></a>
                            @if ($row->regulation_id)
                                <a href="{{ route('regulationReport', $row->regulation_id) }}" target="_blank"
                                    class="btn btn-default"><i class="fas fa-print" title="print"></i></a>
                            @endif

                            @if ($row->diary_id)
                                <a href="{{ route('diaryReport', $row->diary_id) }}" target="_blank"
                                    class="btn btn-default"><i class="fas fa-print" title="print"></i></a>
                            @endif

                            @if ($row->letter_id)
                                <a href="{{ route('letterReport', $row->letter_id) }}" target="_blank"
                                    class="btn btn-default"><i class="fas fa-print" title="print"></i></a>
                            @endif

                            {{-- @if ($row->petition_id)
                                <a href="{{ route('petitionReport', $row->petition_id) }}" target="_blank"
                                    class="btn btn-default"><i class="fas fa-print" title="print"></i></a>
                            @endif --}}
                        @endcan
                        @can('cases-delete')
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                data-target="#del{{ $row->id }}"><i class="fas fa-trash-alt"></i></button>
                        @endcan


                    </div>
                </th>
            </tr>
            <!-- Delete Modal -->
            <div class="modal fade dir-rtl" id="del{{ $row->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('presdure.destroy', $row->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header bg-gradient-danger">
                                <h5 class="modal-title" id="exampleModalLabel">تأكيد الحذف</h5>
                                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <h3><i class="fas fa-fire text-danger"></i></h3>
                                <h4 class="text-danger">حذف جميع البيانات ؟</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                <button type="submit" class="btn btn-danger">تأكيد</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Done Modal -->
            <div class="modal fade dir-rtl" id="doneProced{{ $row->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('procedDone') }}" method="POST">
                            @csrf
                            <input type="hidden" name="case_task" value="{{ $row->id }}">
                            <input type="hidden" name="case_id" value="{{ $case->id }}">
                            <div class="modal-header bg-light">
                                <h5 class="modal-title" id="exampleModalLabel">تأكيد الإنجاز</h5>
                                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <h3><i class="fas fa-fire text-primary"></i></h3>
                                <h4>تأكيد إنجاز المهمة</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                <button type="submit" class="btn btn-success">تأكيد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>

<div class="btn-group">
    <button type="button" class="btn btn-default"> إضافة إجراء
    </button>
    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu" role="menu">
        <a class="dropdown-item" href="{{ route('regulation.edit', $case->id) }}" >لوائح اعتراضية</a>
        <a class="dropdown-item" href="{{ route('diary.edit', $case->id) }}" >مذكرات</a>
        <a class="dropdown-item" href="{{ route('letter.edit', $case->id) }}" >خطابات</a>
        <a class="dropdown-item" href="{{ route('petition.edit', $case->id) }}" >التماس إعادة النظر</a>
        <a class="dropdown-item"  href="{{ route('session.edit', $case->id) }}" >جلسات</a>
        <a class="dropdown-item" href="{{ route('createReferral', $case->id) }}" >إحالة</a>
        @hasrole('Admin')
            <a class="dropdown-item" data-toggle="modal" data-target="#archive{{ $case->id }}">تحويل إلي
                الارشيف</a>
        @endhasrole

        {{-- <a class="dropdown-item" data-toggle="modal" data-target="#add-tab7_show">المرفقات</a> --}}
    </div>
</div>
<!-- Add Tab-5letters  Modal -->
<div class="modal fade dir-rtl" id="add-tab_referral_show" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة بيانات الإحاله </h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-edit text-success"></i></h3>
                <form role="form" action="{{ route('memberReferral') }}" method="post">
                    @csrf
                    <input type="hidden" name="case_id" value="{{ $case->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">المكلف</label>
                                    <select class="custom-select" name="member_id">
                                        @foreach ($users as $type)
                                            <option {{ Auth::user()->id == $type->id ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ الإحالة </label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="letter_date"
                                        class="form-control" id="">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">وقت الإحالة </label>
                                    <input type="time" id="appt" name="referral" min="09:00" max="18:00"
                                        class="form-control">

                                </div>
                            </div>



                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>سبب الإحالة </label>
                                    <textarea name="reason" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">تأكيد</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Add Tab-3 Modal regulation -->
<div class="modal fade dir-rtl" id="add-tab3_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة بيانات لوائح اعتراضية</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-edit text-success"></i></h3>
                <form role="form" action="{{ route('regulation.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="case_id" value="{{ $case->id }}">


                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>منطوق الحكم</label>
                                    <textarea name="facts" class="form-control" rows="5">{{ old('facts') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>الدفوع</label>
                                    <textarea name="defenses" class="form-control" rows="5">{{ old('defenses') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>الطلبات</label>
                                    <textarea name="requirements" class="form-control" rows="5">{{ old('requirements') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>الشكلية الموضوعية</label>
                                    <textarea name="text" class="form-control" rows="5">{{ old('text') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">تاريخ اللائحة</label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="regulation_date"
                                        class="form-control" id=""
                                        placeholder="{{ date('d-m-Y', strtotime(Carbon\Carbon::now())) }}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">تاريخ التسليم </label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="regulation_end_date"
                                        class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">المكلف</label>
                                    <select class="custom-select" name="member_id">
                                        @foreach ($users as $type)
                                            <option {{ Auth::user()->id == $type->id ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">تأكيد</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Add Tab-4 diary Modal -->
<div class="modal fade dir-rtl" id="add-tab4_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة بيانات المذكرات </h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-edit text-success"></i></h3>
                <form role="form" action="{{ route('diary.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="case_id" value="{{ $case->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>نص المذكرة</label>
                                    <textarea name="text" class="form-control " rows="5">{{ old('text') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ المذكرة</label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="diary_date"
                                        placeholder="{{ date('d-m-Y', strtotime(Carbon\Carbon::now())) }}"
                                        class="form-control" id="" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ التسليم </label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="diary_end_date"
                                        class="form-control" id="">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">المكلف</label>
                                    <select class="custom-select" name="member_id">
                                        @foreach ($users as $type)
                                            <option {{ Auth::user()->id == $type->id ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ملاحظات </label>
                                    <textarea class="form-control" name="notes" rows="5">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">تأكيد</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Add Tab-5letters  Modal -->
<div class="modal fade dir-rtl" id="add-tab5_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة بيانات الخطابات </h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-edit text-success"></i></h3>
                <form role="form" action="{{ route('letter.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="case_id" value="{{ $case->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>نص الخطاب </label>
                                    <textarea id="mytextarea " name="text" class="form-control " rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ الخطاب </label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="letter_date"
                                        class="form-control" id="">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ التسليم </label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="letter_end_date"
                                        class="form-control" id=""
                                        placeholder="{{ date('d-m-Y', strtotime(Carbon\Carbon::now())) }}">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">رقم الصادر </label>
                                    <input type="text" name="letter_no" class="form-control" id="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">المكلف</label>
                                    <select class="custom-select" name="member_id">
                                        @foreach ($users as $type)
                                            <option {{ Auth::user()->id == $type->id ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ملاحظات </label>
                                    <textarea name="notes" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">تأكيد</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Add Tab-9 petaintion Modal -->
<div class="modal fade dir-rtl" id="add-tab9_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة بيانات التماس </h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-edit text-success"></i></h3>
                <form role="form" action="{{ route('petition.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="case_id" value="{{ $case->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>نص الإلتماس </label>
                                    <textarea id="mytextarea " name="text" class="form-control " rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ الإلتماس </label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="petition_date"
                                        class="form-control" id=""
                                        placeholder="{{ date('d-m-Y', strtotime(Carbon\Carbon::now())) }}">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ التسليم </label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="petition_end_date"
                                        class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">المكلف</label>
                                    <select class="custom-select" name="member_id">
                                        @foreach ($users as $type)
                                            <option {{ Auth::user()->id == $type->id ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
                  <div class="form-group">
                      <label for="">الحالة</label>
                      <input type="text" class="form-control" id="" readonly>
                  </div>
              </div> --}}
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ملاحظات </label>
                                    <textarea name="notes" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">تأكيد</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Add Tab-6 Modalsession -->
<div class="modal fade dir-rtl" id="add-tab6_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة بيانات الجلسات </h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-edit text-success"></i></h3>
                <form role="form" action="{{ route('session.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="case_id" value="{{ $case->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label> طلبات الجلسة </label>
                                    <textarea id="mytextarea " name="text" class="form-control " rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ الجلسة </label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="session_date"
                                        class="form-control" id=""
                                        placeholder="{{ date('d-m-Y', strtotime(Carbon\Carbon::now())) }}">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">المكلف</label>
                                    <select class="custom-select" name="member_id">
                                        @foreach ($users as $type)
                                            <option {{ Auth::user()->id == $type->id ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>تقرير الجلسة </label>
                                    <textarea name="notes" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">تأكيد</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Add Tab-7 Modal attachment-->
<div class="modal fade dir-rtl" id="add-tab7_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة بيانات المرفقات</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-edit text-success"></i></h3>
                <form action="{{ route('attachment.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="case_id" value="{{ $case->id }}">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">اضافة ملفات مرفقة</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="name" id="customFile">
                                        <label class="custom-file-label" for="customFile">إختار ملف</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>الوصف</label>
                                    <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>ملاحظات </label>
                                    <textarea name="notes" class="form-control" rows="5">{{ old('notes') }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">تأكيد</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
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
                    <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h3><i class="fas fa-fire text-primary"></i>
                    </h3>
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
