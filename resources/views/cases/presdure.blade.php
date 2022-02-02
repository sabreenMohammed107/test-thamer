<h3 class="card-title float-sm-left">

</h3>
<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th> نوع الإجراء</th>
            <th>التاريخ</th>
            <th>الزميل المكلف</th>
            <th>الحالة </th>
            <th>ملاحظات</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($presdures as $index => $row)
            <tr>
                <th>{{ $index + 1 }}</th>
                <th> {{ $row->type->type ?? '' }}</th>
                <th>{{ date('Y/m/d', strtotime($row->task_date)) }} </th>
                <th> {{ $row->member->name ?? '' }}</th>
                <th>
                    <div class="btn-group">
                        @if ($row->task_status_id == 1)
                            <i class="fas fa-check"></i>

                        @else
                            <i class="fas fa-times"></i>

                        @endif
                    </div>
                </th>

                <th>{{ $row->notes }}</th>
                <th>
                    <div class="btn-group">
                        <?php
                        $regulation = App\Models\Interceptions_regulation::where([['case_id', '=', $row->case_id], ['member_id', '=', $row->member_id], ['regulation_date', '=', $row->task_date]])->first();
                        $diary = App\Models\Diary::where([['case_id', '=', $row->case_id], ['member_id', '=', $row->member_id], ['diary_date', '=', $row->task_date]])->first();
                        $letter = App\Models\Letter::where([['case_id', '=', $row->case_id], ['member_id', '=', $row->member_id], ['letter_date', '=', $row->task_date]])->first();
                        $petition = App\Models\Petition::where([['case_id', '=', $row->case_id], ['member_id', '=', $row->member_id], ['petition_date', '=', $row->task_date]])->first();

                        ?>
                        @if ($row->task_type_id == 1)

                            {{-- <a @if (isset($regulation)) href="{{route('regulation.show', $regulation->id) }}" @endif class="btn btn-default"><i class="fas fa-eye" title="view"></i></a> --}}
                            @if (isset($regulation))
                                <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#view-tab20{{ $regulation->id }}"><i class="fas fa-edit"
                                        title="view"></i></button>
                                <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#view-tab20{{ $regulation->id }}"><i class="fas fa-eye"
                                        title="view"></i></button>
                                <!-- View Tab-3 Modal -->
                                <div class="modal fade dir-rtl" id="view-tab20{{ $regulation->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title" id="exampleModalLabel">عرض بيانات لوائح
                                                    اعتراضية</h5>
                                                <button type="button" class="close m-0 p-0 text-white"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h3><i class="fas fa-edit text-success"></i></h3>
                                                <form role="form">

                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>الوقائع</label>
                                                                    <textarea name="facts" class="form-control"
                                                                        rows="5">{{ $regulation->facts }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>الدفوع</label>
                                                                    <textarea name="defenses" class="form-control"
                                                                        rows="5">{{ $regulation->defenses }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>الطلبات</label>
                                                                    <textarea name="requirements" class="form-control"
                                                                        rows="5">{{ $regulation->requirements }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>نص</label>
                                                                    <textarea name="text" class="form-control"
                                                                        rows="5">{{ $regulation->text }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">تاريخ اللائحة</label>
                                                                    <input type="text" autocomplete="off"
                                                                        class="form-control txt-rtl hijri-date-default"
                                                                        value="" name="regulation_date" id="inputEmail3"
                                                                        placeholder="{{ date('d-m-Y', strtotime($regulation->regulation_date)) }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">تاريخ التسليم </label>
                                                                    <input type="text" autocomplete="off"
                                                                        class="form-control txt-rtl hijri-date-default"
                                                                        value="" name="regulation_end_date"
                                                                        id="inputEmail3"
                                                                        placeholder="{{ date('d-m-Y', strtotime($row->end_date)) }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">الزميل المكلف</label>
                                                                    <select class="custom-select dynamic"
                                                                        name="member_id" id="member_id">
                                                                        <option>اختر </option>

                                                                        @foreach ($users as $type)
                                                                            <option
                                                                                {{ $regulation->member_id == $type->id ? 'selected' : '' }}
                                                                                value="{{ $type->id }}">
                                                                                {{ $type->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-sm-6">

                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>ملاحظات </label>
                                                                    <textarea name="notes" class="form-control"
                                                                        rows="5">{{ $regulation->notes }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">إلغاء</button>
                                                        {{-- <button type="button" class="btn btn-success">تأكيد</button> --}}
                                                        </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif
                        @elseif ($row->task_type_id == 2)

                            @if (isset($diary))
                                <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#view-tab21{{ $diary->id }}"><i class="fas fa-eye"
                                        title="view"></i></button>
                                <!-- View Tab-4 Modal -->
                                <div class="modal fade dir-rtl" id="view-tab21{{ $diary->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title" id="exampleModalLabel">عرض بيانات المذكرات
                                                </h5>
                                                <button type="button" class="close m-0 p-0 text-white"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h3><i class="fas fa-edit text-success"></i></h3>
                                                <form role="form">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>نص المذكرة</label>
                                                                    <textarea name="text" class="form-control content2"
                                                                        rows="20">{{ $diary->text }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">تاريخ المذكرة</label>
                                                                    <input type="text" autocomplete="off"
                                                                        class="form-control txt-rtl hijri-date-default"
                                                                        value="" name="diary_date" id="inputEmail3"
                                                                        placeholder="{{ date('d-m-Y', strtotime($diary->diary_date)) }}">

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">تاريخ التسليم </label>
                                                                    <input type="text" autocomplete="off"
                                                                        class="form-control txt-rtl hijri-date-default"
                                                                        value="" name="diary_end_date" id="inputEmail3"
                                                                        placeholder="{{ date('d-m-Y', strtotime($row->end_date)) }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">الزميل المكلف</label>
                                                                    <select class="custom-select dynamic"
                                                                        name="member_id" id="member_id">
                                                                        <option>اختر </option>

                                                                        @foreach ($users as $type)
                                                                            <option
                                                                                {{ $diary->member_id == $type->id ? 'selected' : '' }}
                                                                                value="{{ $type->id }}">
                                                                                {{ $type->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>ملاحظات </label>
                                                                    <textarea name="notes" class="form-control"
                                                                        rows="5">{{ $diary->notes }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">إلغاء</button>
                                                {{-- <button type="button" class="btn btn-success">تأكيد</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @elseif ($row->task_type_id == 3)

                            @if (isset($letter))
                                <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#view-tab20{{ $letter->id }}"><i class="fas fa-edit"
                                        title="view"></i></button>
                                <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#view-tab22{{ $letter->id }}"><i class="fas fa-eye"
                                        title="view"></i></button>
                                <!-- View Tab-5 Modal -->
                                <div class="modal fade dir-rtl" id="view-tab22{{ $letter->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title" id="exampleModalLabel">عرض بيانات الخطابات
                                                </h5>
                                                <button type="button" class="close m-0 p-0 text-white"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h3><i class="fas fa-edit text-success"></i></h3>
                                                <form role="form">

                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>نص الخطاب </label>
                                                                    <textarea name="text" class="form-control content"
                                                                        rows="20">{{ $letter->text }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">تاريخ الخطاب </label>
                                                                    <input type="text" autocomplete="off"
                                                                        class="form-control txt-rtl hijri-date-default"
                                                                        value="" name="letter_date" id="inputEmail3"
                                                                        placeholder="{{ date('d-m-Y', strtotime($letter->letter_date)) }}">

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">تاريخ التسليم </label>
                                                                    <input type="text" autocomplete="off"
                                                                        class="form-control txt-rtl hijri-date-default"
                                                                        value="" name="letter_end_date" id="inputEmail3"
                                                                        placeholder="{{ date('d-m-Y', strtotime($row->end_date)) }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">رقم الصادر</label>
                                                                    <input type="text"
                                                                        value="{{ $letter->letter_no }}"
                                                                        name="letter_no" class="form-control" id="">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">الزميل المكلف</label>
                                                                    <select class="custom-select dynamic"
                                                                        name="member_id" id="member_id">
                                                                        <option>اختر </option>

                                                                        @foreach ($users as $type)
                                                                            <option
                                                                                {{ $letter->member_id == $type->id ? 'selected' : '' }}
                                                                                value="{{ $type->id }}">
                                                                                {{ $type->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>ملاحظات </label>
                                                                    <textarea name="notes" class="form-control"
                                                                        rows="5">{{ $letter->notes }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- /.card-body -->
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">إلغاء</button>
                                                {{-- <button type="button" class="btn btn-success">تأكيد</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @elseif ($row->task_type_id == 4)

                            @if (isset($petition))

                                <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#view-tab23{{ $petition->id }}"><i class="fas fa-eye"
                                        title="view"></i></button>
                                <!-- View Tab-9 Modal -->
                                <div class="modal fade dir-rtl" id="view-tab23{{ $petition->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title" id="exampleModalLabel">عرض بيانات الإلتماس
                                                </h5>
                                                <button type="button" class="close m-0 p-0 text-white"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h3><i class="fas fa-edit text-success"></i></h3>
                                                <form role="form">

                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>نص الإلتماس </label>
                                                                    <textarea name="text" class="form-control content"
                                                                        rows="20">{{ $petition->text }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">تاريخ الإلتماس </label>
                                                                    <input type="text" autocomplete="off"
                                                                        class="form-control txt-rtl hijri-date-default"
                                                                        value="" name="petition_date" id="inputEmail3"
                                                                        placeholder="{{ date('d-m-Y', strtotime($petition->petition_date)) }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">تاريخ التسليم </label>
                                                                    <input type="text" autocomplete="off"
                                                                        class="form-control txt-rtl hijri-date-default"
                                                                        value="" name="petition_end_date"
                                                                        id="inputEmail3"
                                                                        placeholder="{{ date('d-m-Y', strtotime($row->end_date)) }}">

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">الزميل المكلف</label>
                                                                    <select class="custom-select dynamic"
                                                                        name="member_id" id="member_id">
                                                                        <option>اختر </option>

                                                                        @foreach ($users as $type)
                                                                            <option
                                                                                {{ $petition->member_id == $type->id ? 'selected' : '' }}
                                                                                value="{{ $type->id }}">
                                                                                {{ $type->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>ملاحظات </label>
                                                                    <textarea name="notes" class="form-control"
                                                                        rows="5">{{ $petition->notes }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- /.card-body -->
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">إلغاء</button>
                                                {{-- <button type="button" class="btn btn-success">تأكيد</button> --}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endif
                    </div>
                </th>
            </tr>
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
        <a class="dropdown-item" data-toggle="modal" data-target="#add-tab3_show">لوائح اعتراضية</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#add-tab4_show">مذكرات</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#add-tab5_show">خطابات</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#add-tab9_show">التماس إعادة النظر</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#add-tab6_show">جلسات</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#add-tab7_show">المرفقات</a>
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
                                    <label>الوقائع</label>
                                    <textarea name="facts" class="form-control"
                                        rows="5">{{ old('facts') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>الدفوع</label>
                                    <textarea name="defenses" class="form-control"
                                        rows="5">{{ old('defenses') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>الطلبات</label>
                                    <textarea name="requirements" class="form-control"
                                        rows="5">{{ old('requirements') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>نص</label>
                                    <textarea name="text" class="form-control"
                                        rows="5">{{ old('text') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ اللائحة</label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="regulation_date"
                                        class="form-control" id="">
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
                                    <label for="">الزميل المكلف</label>
                                    <select class="custom-select" name="member_id">
                                        @foreach ($users as $type)
                                            <option {{ old('member_id') == $type->id ? 'selected' : '' }}
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
                                    <textarea name="text" class="form-control content2"
                                        rows="20">{{ old('text') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ المذكرة</label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="diary_date"
                                        class="form-control" id="">
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
                                    <label for="">الزميل المكلف</label>
                                    <select class="custom-select" name="member_id">
                                        @foreach ($users as $type)
                                            <option {{ old('member_id') == $type->id ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ملاحظات </label>
                                    <textarea class="form-control" name="notes"
                                        rows="5">{{ old('notes') }}</textarea>
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
                                    <textarea id="mytextarea content2" name="text" class="form-control content"
                                        rows="20"></textarea>
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
                                        class="form-control" id="">

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
                                    <label for="">الزميل المكلف</label>
                                    <select class="custom-select" name="member_id">
                                        @foreach ($users as $type)
                                            <option {{ old('member_id') == $type->id ? 'selected' : '' }}
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
                                    <textarea id="mytextarea content3" name="text" class="form-control content3"
                                        rows="20"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ الإلتماس </label>
                                    <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="petition_date"
                                        class="form-control" id="">

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
                                    <label for="">الزميل المكلف</label>
                                    <select class="custom-select" name="member_id">
                                        @foreach ($users as $type)
                                            <option {{ old('member_id') == $type->id ? 'selected' : '' }}
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
                                        class="form-control" id="">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">الزميل المكلف</label>
                                    <select class="custom-select" name="member_id">
                                        @foreach ($users as $type)
                                            <option {{ old('member_id') == $type->id ? 'selected' : '' }}
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
                                    <textarea name="description" class="form-control"
                                        rows="5">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>ملاحظات </label>
                                    <textarea name="notes" class="form-control"
                                        rows="5">{{ old('notes') }}</textarea>
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
