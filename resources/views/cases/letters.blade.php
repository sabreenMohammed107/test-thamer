<h3 class="card-title float-sm-left"><a href="" class="btn btn-success" data-toggle="modal" data-target="#add-tab5">إضافة</a></h3>
<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>نص الخطاب </th>
            <th>تاريخ الخطاب </th>
            <th>تاريخ التسليم </th>
            <th>رقم الصادر</th>
            <th> المكلف</th>
<th>الحالة</th>
            <th>ملاحظات</th>
            <th>انجاز</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($letters as $index=>$row)
        <tr>
            <th>{{ $index + 1 }}</th>
            <th>{{ Str::limit($row->text, 50) }}</th>
            <?php
            $task=App\Models\Case_members_task::where([['task_type_id',3],['case_id', '=', $row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $row->letter_date]])->first();
            ?>
            <th>{{date('Y/m/d', strtotime($row->letter_date))}} </th>
            <th>@if($task){{date('Y/m/d', strtotime($task->end_date))}}@endif </th>
            <th>{{$row->letter_no}}</th>
            <th>{{$row->member->name ?? ''}}</th>
            <th>@if($task && $task->task_status_id==1) منجزة @else غير منجزة @endif</th>
            <th>{{$row->notes}}</th>
            <th>
                <div class="btn-group">
                    <button type="button"  @if($task && $task->task_status_id==1) disabled @endif class="btn btn-default" data-toggle="modal" data-target="#done2{{ $row->id }}"><i class="fas fa-check" title="view"></i></button>
                </div>
            </th>
            <th>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#view-tab5{{$row->id}}"><i class="fas fa-eye" title="view"></i></button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#edit-tab5{{$row->id}}"><i class="fas fa-edit" title="edit"></i></button>
                    {{-- <button type="button" class="btn btn-default"><i class="fas fa-print" title="print"></i></button> --}}
                    @can('cases-delete')
                    <button type="button" class="btn btn-default" data-toggle="modal"
                    data-target="#del{{ $row->id }}"><i class="fas fa-trash-alt"></i></button>
                                     @endcan
                    </div>
                </th>
            </tr>
                 <!-- Done Modal -->
                 <div class="modal fade dir-rtl" id="done2{{ $row->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('letterDone') }}" method="POST">
                                @csrf
                                <input type="hidden" name="letter" value="{{ $row->id }}">
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
        <form action="{{ route('letter.destroy', $row->id) }}" method="POST">
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

  <!-- Edit Tab-5 Modal -->
  <div class="modal fade dir-rtl" id="edit-tab5{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات الخطابات </h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-edit text-success"></i></h3>
                <form role="form" action="{{ route('letter.update',$row->id) }}"
                    method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="case_id" value="{{$case->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>نص الخطاب </label>
                                    <textarea  name="text" class="form-control content" rows="20">{{$row->text}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ الخطاب </label>
                                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                        value=""
                                        name="letter_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($row->letter_date)) }}">

                                </div>
                            </div>
                            <?php
                            $task=App\Models\Case_members_task::where([['task_type_id',3],['case_id', '=',$row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $row->letter_date]])->first();
                            ?>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ التسليم </label>
                                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                    value=  ""
                                    name="letter_end_date" id="inputEmail3" placeholder="@if($task){{ date('d-m-Y', strtotime($task->end_date))}}@endif">
                                                                   </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">رقم الصادر</label>
                                    <input type="text" value="{{$row->letter_no}}" name="letter_no" class="form-control" id="">
                                </div>
                            </div>

                            {{-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">المكلف</label>
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
                            </div> --}}
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
<!-- View Tab-5 Modal -->
<div class="modal fade dir-rtl" id="view-tab5{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">عرض بيانات الخطابات </h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
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
                                <div class="form-group">
                                    <label>نص الخطاب </label>
                                    <textarea  name="text" class="form-control content" rows="20">{{$row->text}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ الخطاب </label>
                                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                        value=""
                                        name="letter_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($row->letter_date)) }}">

                                </div>
                            </div>
                            <?php
                            $task=App\Models\Case_members_task::where([['task_type_id',3],['case_id', '=',$row->case_id], ['member_id', '=',  $row->member_id], ['task_date', '=', $row->letter_date]])->first();
                            ?>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ التسليم </label>
                                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                    value=  ""
                                    name="letter_end_date" id="inputEmail3" placeholder="@if($task){{ date('d-m-Y', strtotime($task->end_date))}}@endif">
                                                                   </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">رقم الصادر</label>
                                    <input type="text" value="{{$row->letter_no}}" name="letter_no" class="form-control" id="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">المكلف</label>
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
                {{-- <button type="button" class="btn btn-success">تأكيد</button> --}}
            </div>
        </div>
    </div>
</div>
        @endforeach
    </tbody>
</table>



        <!-- Add Tab-5 Modal -->
        <div class="modal fade dir-rtl" id="add-tab5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <form role="form" action="{{route('letter.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="case_id" value="{{$case->id}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>نص الخطاب </label>
                                            <textarea id="mytextarea content2" name="text" class="form-control content" rows="20"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">تاريخ الخطاب </label>
                                            <input type="text" autocomplete="off" value=""
                                            class="form-control txt-rtl hijri-date-default" name="letter_date" class="form-control" id="">

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">تاريخ التسليم </label>
                                            <input type="text" autocomplete="off" value=""
                                            class="form-control txt-rtl hijri-date-default" name="letter_end_date" class="form-control" id="">

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

