<h3 class="card-title float-sm-left"><a href="" class="btn btn-success" data-toggle="modal" data-target="#add-tab4">إضافة</a></h3>
<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>نص المذكرة</th>
            <th>تاريخ المذكرة </th>
            <th>تاريخ التسليم</th>
            <th>الزميل المكلف</th>
            <th> الحاله</th>
            <th>ملاحظات</th>
            <th>انجاز</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($diaries as $index=>$row)
        <tr>
            <th>{{ $index + 1 }}</th>
            <th>{{ Str::limit($row->text, 50) }}</th>
            <?php
            $task=App\Models\Case_members_task::where([['task_type_id',2],['case_id', '=', $row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $row->diary_date]])->first();
            ?>
            <th>{{date('Y/m/d', strtotime($row->diary_date))}} </th>
            <th>@if($task){{date('Y/m/d', strtotime($task->end_date))}}@endif </th>

            <th>{{$row->member->name ?? ''}}</th>
            <th>@if($task->task_status_id==1) منجزة @else غير منجزة @endif</th>
            <th>{{$row->notes}}</th>
            <th>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#done4{{ $row->id }}"><i class="fas fa-check" title="view"></i></button>
                </div>
            </th>
            <th>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#view-tab4{{$row->id}}"><i class="fas fa-eye" title="view"></i></button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#edit-tab4{{$row->id}}"><i class="fas fa-edit" title="edit"></i></button>
                    {{-- <button type="button" class="btn btn-default"><i class="fas fa-print" title="print"></i></button> --}}
                    @can('cases-delete')
                    <button type="button" class="btn btn-default" data-toggle="modal"
                    data-target="#del{{ $row->id }}"><i class="fas fa-trash-alt"></i></button>
                                     @endcan
                    </div>
                </th>
            </tr>
              <!-- Done Modal -->
              <div class="modal fade dir-rtl" id="done4{{ $row->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('diaryDone') }}" method="POST">
                            @csrf
                            <input type="hidden" name="diary" value="{{ $row->id }}">
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
                                <h4>تأكيد إنجاز القضية</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                <button type="submit" class="btn btn-success">تأكيد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!-- Delete Modal -->
<div class="modal fade dir-rtl" id="del{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('diary.destroy', $row->id) }}" method="POST">
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
          <!-- Edit Tab-4 Modal -->
    <div class="modal fade dir-rtl" id="edit-tab4{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات المذكرات </h5>
                    <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h3><i class="fas fa-edit text-success"></i></h3>
                    <form role="form" action="{{ route('diary.update',$row->id) }}"
                        method="post">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="case_id" value="{{$case->id}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>نص المذكرة</label>
                                        <textarea  name="text" class="form-control content2" rows="20">{{$row->text}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">تاريخ المذكرة</label>
                                        <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                        value=""
                                        name="diary_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($row->diary_date)) }}">

                                    </div>
                                </div>
                                <?php
                                $task=App\Models\Case_members_task::where([['task_type_id',2],['case_id', '=',$row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $row->diary_date]])->first();
                                ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">تاريخ التسليم </label>
                                        <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                        value=  ""
                                        name="diary_end_date" id="inputEmail3" placeholder="@if($task){{ date('d-m-Y', strtotime($task->end_date))}}@endif">
                                                                       </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">الزميل المكلف</label>
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

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ملاحظات </label>
                                        <textarea name="notes" class="form-control" rows="5">{{$row->notes}}</textarea>
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
    <!-- View Tab-4 Modal -->
    <div class="modal fade dir-rtl" id="view-tab4{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">عرض بيانات المذكرات </h5>
                    <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
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
                                        <textarea  name="text" class="form-control content2" rows="20">{{$row->text}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">تاريخ المذكرة</label>
                                        <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                        value=""
                                        name="diary_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($row->diary_date)) }}">

                                    </div>
                                </div>
                                <?php
                                $task=App\Models\Case_members_task::where([['task_type_id',2],['case_id', '=',$row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $row->updated_at]])->first();
                                ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">تاريخ التسليم </label>
                                        <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                        value=  ""
                                        name="diary_end_date" id="inputEmail3" placeholder="@if($task){{ date('d-m-Y', strtotime($task->end_date))}}@endif">
                                                                       </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">الزميل المكلف</label>
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

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ملاحظات </label>
                                        <textarea name="notes" class="form-control" rows="5">{{$row->notes}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-success">تأكيد</button>
                </div>
            </div>
        </div>
    </div>
        @endforeach
    </tbody>
</table>


    <!-- Add Tab-4 Modal -->
    <div class="modal fade dir-rtl" id="add-tab4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form role="form" action="{{route('diary.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="case_id" value="{{$case->id}}">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>نص المذكرة</label>
                                        <textarea name="text" class="form-control content2" rows="20">{{ old('text') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">تاريخ المذكرة</label>
                                        <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="diary_date" class="form-control" id="">
                                      </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">تاريخ التسليم </label>
                                        <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="diary_end_date" class="form-control" id="">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">الزميل المكلف</label>
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

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ملاحظات </label>
                                        <textarea class="form-control" name="notes" rows="5">{{ old('notes') }}</textarea>                                    </div>
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


