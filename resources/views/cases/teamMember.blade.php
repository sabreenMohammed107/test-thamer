<h3 class="card-title float-sm-left"><a href="" class="btn btn-success" data-toggle="modal"
        data-target="#add-tab2">إضافة</a></h3>
<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>اسم المكلف</th>
            <th>تاريخ التكليف</th>
            <th>نشط</th>
            <th>ملاحظات</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $index => $row)
        <?php
        $regulation =null;
        $diary = null;
        $letter = null;
        $petition =null;

        ?>
            <tr>
                <th>{{ $index + 1 }}</th>
                <th>{{ $row->member->name ?? '' }}</th>
                <th>{{ date('Y/m/d', strtotime($row->incharge_date)) }} </th>
                <th>@if ($row->active == 1) <i class="fas fa-check" title="view"></i>@else <i class="fas fa-times" title="view"></i> @endif</th>
                <th>{{ $row->notes }}</th>
                <th>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-toggle="modal"
                            data-target="#view-tab2{{ $row->id }}"><i class="fas fa-eye"
                                title="view"></i></button>
                        <button type="button" class="btn btn-default" data-toggle="modal"
                            data-target="#edit-tab2{{ $row->id }}"><i class="fas fa-edit"
                                title="edit"></i></button>
                        {{-- <button type="button" class="btn btn-default"><i class="fas fa-print" title="print"></i></button> --}}
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
        <form action="{{ route('case-member.destroy', $row->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-gradient-danger">
                    <h5 class="modal-title" id="exampleModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="close m-0 p-0 text-white"
                        data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h3><i class="fas fa-fire text-danger"></i></h3>
                    <h4 class="text-danger">حذف جميع البيانات ؟</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">تأكيد</button>
                </div>
            </div>
        </form>
    </div>
</div>
            <!-- Edit Tab-2 Modal -->
            <div class="modal fade dir-rtl" id="edit-tab2{{ $row->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل فريق العمل</h5>
                            <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h3><i class="fas fa-edit text-success"></i></h3>
                            <form role="form" action="{{ route('case-member.update',$row->id) }}"
                                method="post">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="case_id" value="{{$case->id}}">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">إسم
                                                    المكلف</label>
                                                <div class="col-sm-8">
                                                    <select class="custom-select dynamic" name="member_id"
                                                        id="member_id">
                                                        <option>اختر </option>

                                                        @foreach ($users as $type)
                                                            <option
                                                                {{ $row->member_id == $type->id ? 'selected' : '' }}
                                                                value="{{ $type->id }}">
                                                                {{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">تاريخ
                                                    التكليف</label>
                                                <div class="col-sm-8">
                                                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                                        value=""
                                                        name="incharge_date" pattern="" id="inputEmail3" placeholder="{{ date('Y/m/d', strtotime($row->incharge_date)) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">حالة
                                                    المكلف</label>
                                                <div class="col-sm-8">
                                                    <select class="custom-select" id="incharge_type"
                                                        name="incharge_type">
                                                        <option {{ $row->incharge_type == 0 ? 'selected' : '' }}
                                                            value="0">غير نشط</option>
                                                        <option {{ $row->incharge_type == 1 ? 'selected' : '' }}
                                                            value="1"> نشط</option>

                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">ملاحظات
                                                    ...</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" name="notes"
                                                        rows="3">{{ $row->notes }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 mb-2">
                                            <h5 class="mb-2 text-success">تعديل مهام</h5>
                                        </div>

                                        <?php
                                        $regulation = App\Models\Interceptions_regulation::where([['case_id', '=', $row->case_id], ['member_id', '=', $row->member_id]])->first();
                                        $diary = App\Models\Diary::where([['case_id', '=',  $row->case_id], ['member_id', '=', $row->member_id]])->first();
                                        $letter = App\Models\Letter::where([['case_id', '=', $row->case_id], ['member_id', '=', $row->member_id]])->first();
                                        $petition = App\Models\Petition::where([['case_id', '=',  $row->case_id], ['member_id', '=', $row->member_id]])->first();
                                        $task1=App\Models\Case_members_task::where([['task_type_id',1],['case_id', '=',$row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $regulation->regulation_date ?? null]])->first();
                                        $task2=App\Models\Case_members_task::where([['task_type_id',2],['case_id', '=',$row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $diary->diary_date ?? null ]])->first();
                                        $task3=App\Models\Case_members_task::where([['task_type_id',3],['case_id', '=',$row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $letter->letter_date ?? null]])->first();
                                        $task4=App\Models\Case_members_task::where([['task_type_id',4],['case_id', '=',$row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $petition->petition_date ?? null]])->first();
                                    ?>

                                        <div class="col-sm-4">
                                            <div class="form-group d-flex flex-row">
                                                <div class="form-group clearfix mt-2">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" name="regulations"
                                                            @if (isset($regulation)) checked @endif />
                                                        <label for="checkboxPrimary1">لائحة اعتراضية</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">تاريخ
                                                    التسليم</label>
                                                <div class="col-sm-7">
                                                    <input type="text" autocomplete="off" value=""  name="regulation_end_date"
                                                        class="form-control txt-rtl hijri-date-default" id="" @if (isset($task1)) placeholder="{{ date('Y/m/d', strtotime($task1->end_date)) }}" @endif>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group d-flex flex-row">
                                                <div class="form-group clearfix mt-2">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" name="diary" @if (isset($diary)) checked @endif />
                                                        <label for="checkboxPrimary1">مذكرة</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">تاريخ
                                                    التسليم</label>
                                                <div class="col-sm-7">
                                                    <input type="text" autocomplete="off"  name="diary_end_date"
                                                        class="form-control txt-rtl hijri-date-default" id="" @if (isset($task2)) placeholder="{{ date('Y/m/d', strtotime($task2->end_date)) }}" @endif >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group d-flex flex-row">
                                                <div class="form-group clearfix mt-2">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" name="letter" @if (isset($letter)) checked @endif />
                                                        <label for="checkboxPrimary1">خطاب</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">تاريخ
                                                    التسليم</label>
                                                <div class="col-sm-7">
                                                    <input type="text" autocomplete="off" value="" name="letter_end_date"
                                                        class="form-control txt-rtl hijri-date-default" @if (isset($task3)) placeholder="{{ date('Y/m/d', strtotime($task3->end_date)) }}" @endif  id="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group d-flex flex-row">
                                                <div class="form-group clearfix mt-2">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" name="petition"
                                                            @if (isset($petition)) checked @endif />

                                                        <label for="checkboxPrimary1">التماس إعادة النظر</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">تاريخ
                                                    التسليم</label>
                                                <div class="col-sm-7">
                                                    <input type="text" autocomplete="off" value=""  name="petition_end_date"
                                                        class="form-control txt-rtl hijri-date-default" id="" @if (isset($task4)) placeholder="{{ date('Y/m/d', strtotime($task4->end_date)) }}" @endif>
                                                </div>
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
            <!-- View Tab-2 Modal -->
            <div class="modal fade dir-rtl" id="view-tab2{{ $row->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLabel">عرض بيانات فريق العمل</h5>
                            <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h3><i class="fas fa-edit text-success"></i></h3>
                            <form role="form">
                                <input type="hidden" name="case_id" value="{{$case->id}}">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">إسم
                                                    المكلف</label>
                                                <div class="col-sm-8">
                                                    <select class="custom-select dynamic" name="member_id"
                                                        id="member_id">
                                                        <option>اختر </option>

                                                        @foreach ($users as $type)
                                                            <option
                                                                {{ $row->member_id == $type->id ? 'selected' : '' }}
                                                                value="{{ $type->id }}">
                                                                {{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">تاريخ
                                                    التكليف</label>
                                                <div class="col-sm-8">
                                                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                                        value=""
                                                        name="incharge_date" pattern="" id="inputEmail3" placeholder="{{ date('Y/m/d', strtotime($row->incharge_date)) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">حالة
                                                    المكلف</label>
                                                <div class="col-sm-8">
                                                    <select class="custom-select" id="incharge_type"
                                                        name="incharge_type">
                                                        <option {{ $row->incharge_type == 0 ? 'selected' : '' }}
                                                            value="0">غير نشط</option>
                                                        <option {{ $row->incharge_type == 1 ? 'selected' : '' }}
                                                            value="1"> نشط</option>

                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">ملاحظات
                                                    ...</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" name="notes"
                                                        rows="3">{{ $row->notes }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 mb-2">
                                            <h5 class="mb-2 text-success">تعديل مهام</h5>
                                        </div>

                                        <?php
                                        $regulation = App\Models\Interceptions_regulation::where([['case_id', '=', $row->case_id], ['member_id', '=', $row->member_id]])->first();
                                        $diary = App\Models\Diary::where([['case_id', '=',  $row->case_id], ['member_id', '=', $row->member_id]])->first();
                                        $letter = App\Models\Letter::where([['case_id', '=', $row->case_id], ['member_id', '=', $row->member_id]])->first();
                                        $petition = App\Models\Petition::where([['case_id', '=',  $row->case_id], ['member_id', '=', $row->member_id]])->first();

                                        $task1=App\Models\Case_members_task::where([['task_type_id',1],['case_id', '=',$row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $regulation->regulation_date ?? null]])->first();
                                        $task2=App\Models\Case_members_task::where([['task_type_id',2],['case_id', '=',$row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $diary->diary_date ?? null]])->first();
                                        $task3=App\Models\Case_members_task::where([['task_type_id',3],['case_id', '=',$row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $letter->letter_date ?? null]])->first();
                                        $task4=App\Models\Case_members_task::where([['task_type_id',4],['case_id', '=',$row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $petition->petition_date ?? null]])->first();
                                      ?>

                                        <div class="col-sm-4">
                                            <div class="form-group d-flex flex-row">
                                                <div class="form-group clearfix mt-2">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" name="regulations"
                                                            @if (isset($regulation)) checked @endif />
                                                        <label for="checkboxPrimary1">لائحة اعتراضية</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">تاريخ
                                                    التسليم</label>
                                                <div class="col-sm-7">
                                                    <input type="text" autocomplete="off" value=""  name="regulation_end_date"
                                                        class="form-control txt-rtl hijri-date-default" id="" @if (isset($task1)) placeholder="{{ date('Y/m/d', strtotime($task1->end_date)) }}" @endif>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group d-flex flex-row">
                                                <div class="form-group clearfix mt-2">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" name="diary" @if (isset($diary)) checked @endif />
                                                        <label for="checkboxPrimary1">مذكرة</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">تاريخ
                                                    التسليم</label>
                                                <div class="col-sm-7">
                                                    <input type="text" autocomplete="off" name="diary_end_date"
                                                        class="form-control txt-rtl hijri-date-default" id="" @if (isset($task2)) placeholder="{{ date('Y/m/d', strtotime($task2->end_date)) }}" @endif >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group d-flex flex-row">
                                                <div class="form-group clearfix mt-2">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" name="letter" @if (isset($letter)) checked @endif />
                                                        <label for="checkboxPrimary1">خطاب</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">تاريخ
                                                    التسليم</label>
                                                <div class="col-sm-7">
                                                    <input type="text" autocomplete="off" value="" name="letter_end_date"
                                                        class="form-control txt-rtl hijri-date-default" @if (isset($task3)) placeholder="{{ date('Y/m/d', strtotime($task3->end_date)) }}" @endif  id="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group d-flex flex-row">
                                                <div class="form-group clearfix mt-2">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" name="petition"
                                                            @if (isset($petition)) checked @endif />

                                                        <label for="checkboxPrimary1">التماس إعادة النظر</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">تاريخ
                                                    التسليم</label>
                                                <div class="col-sm-7">
                                                    <input type="text" autocomplete="off" value=""  name="petition_end_date"
                                                        class="form-control txt-rtl hijri-date-default" id="" @if (isset($task4)) placeholder="{{ date('Y/m/d', strtotime($task4->end_date)) }}" @endif>
                                                </div>
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


            <!-- end-models -->
        @endforeach

    </tbody>
</table>

<!-- Modeles -->
<!-- Add Tab-2 Modal -->
<div class="modal fade dir-rtl" id="add-tab2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة فريق العمل</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-edit text-success"></i></h3>
                <form role="form" action="{{route('case-member.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="case_id" value="{{$case->id}}">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">إسم المكلف</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="member_id">
                                            @foreach ($users as $type)
                                            <option
                                                {{  old('member_id') == $type->id ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">تاريخ التكليف</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="" autocomplete="off"
                                            name="incharge_date" class="form-control txt-rtl hijri-date-default" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">حالة المكلف</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="active">
                                            <option value="0" {{ old('active') == 0 ? 'selected' : '' }}>
                                                غير نشط</option>
                                            <option value="1" {{ old('active') == 1 ? 'selected' : '' }}>
                                                نشط</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">ملاحظات ...</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="2"
                                            name="notes">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <h5 class="mb-2 text-success">إضافة مهام</h5>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group d-flex flex-row">
                                    <div class="form-group clearfix mt-2">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="regulations" @if (old('regulation')) checked @endif />
                                            <label for="checkboxPrimary1">لائحة اعتراضية</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">تاريخ التسليم</label>
                                    <div class="col-sm-7">
                                        <input type="text" value="" autocomplete="off"
                                        name="regulation_end_date" class="form-control txt-rtl hijri-date-default" id="">                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group d-flex flex-row">
                                    <div class="form-group clearfix mt-2">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="diary" @if (old('diary')) checked @endif />
                                            <label for="checkboxPrimary1">مذكرة</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">تاريخ التسليم</label>
                                    <div class="col-sm-7">
                                        <input type="text" value="" autocomplete="off"
                                        name="diary_end_date" class="form-control txt-rtl hijri-date-default" id="">                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group d-flex flex-row">
                                    <div class="form-group clearfix mt-2">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="letter" @if (old('letter')) checked @endif />
                                            <label for="checkboxPrimary1">خطاب</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">تاريخ التسليم</label>
                                    <div class="col-sm-7">
                                        <input type="text" value="" autocomplete="off"
                                        name="letter_end_date" class="form-control txt-rtl hijri-date-default" id="">                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group d-flex flex-row">
                                    <div class="form-group clearfix mt-2">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="petition" @if (old('petition')) checked @endif />
                                            <label for="checkboxPrimary1">التماس اعاده النظر</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">تاريخ التسليم</label>
                                    <div class="col-sm-7">
                                        <input type="text" value="" autocomplete="off"
                                        name="petition_end_date" class="form-control txt-rtl hijri-date-default" id="">                                    </div>
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


<!-- end-models -->
