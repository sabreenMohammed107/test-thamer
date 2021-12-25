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

                <th>ملاحظات</th>
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
                        @elseif ($row->task_type_id==2)

                                    @if (isset($diary))
                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                        data-target="#view-tab21{{ $diary->id }}"><i class="fas fa-eye"
                                            title="view"></i></button>
                                             <!-- View Tab-4 Modal -->
    <div class="modal fade dir-rtl" id="view-tab21{{ $diary->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <textarea  name="text" class="form-control content2" rows="20">{{$diary->text}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">تاريخ المذكرة</label>
                                        <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                        value=""
                                        name="diary_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($diary->diary_date)) }}">

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">تاريخ التسليم </label>
                                        <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                        value=  ""
                                        name="diary_end_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($row->end_date))}}">
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
                                        <textarea name="notes" class="form-control" rows="5">{{$diary->notes}}</textarea>
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
                                            @endif

                        @elseif ($row->task_type_id==3)

                                    @if (isset($letter))

                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                        data-target="#view-tab22{{ $letter->id }}"><i class="fas fa-eye"
                                            title="view"></i></button>
                                            <!-- View Tab-5 Modal -->
<div class="modal fade dir-rtl" id="view-tab22{{ $letter->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>نص الخطاب </label>
                                    <textarea  name="text" class="form-control content" rows="20">{{$letter->text}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ الخطاب </label>
                                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                        value=""
                                        name="letter_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($letter->letter_date)) }}">

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ التسليم </label>
                                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                    value=  ""
                                    name="letter_end_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($row->end_date))}}">
                                                                   </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">رقم الصادر</label>
                                    <input type="text" value="{{$letter->letter_no}}" name="letter_no" class="form-control" id="">
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
                                    <textarea name="notes" class="form-control" rows="5">{{$letter->notes}}</textarea>
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
                                    @endif
                        @elseif ($row->task_type_id==4)

                                    @if (isset($petition))

                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                        data-target="#view-tab23{{ $petition->id }}"><i class="fas fa-eye"
                                            title="view"></i></button>
                                            <!-- View Tab-9 Modal -->
<div class="modal fade dir-rtl" id="view-tab23{{$petition->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">عرض بيانات الإلتماس </h5>
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
                                    <label>نص الإلتماس </label>
                                    <textarea  name="text" class="form-control content" rows="20">{{$petition->text}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ الإلتماس </label>
                                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                    value=""
                                    name="petition_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($petition->petition_date)) }}">
                            </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ التسليم </label>
                                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                    value=  ""
                                    name="petition_end_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($row->end_date))}}">

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
                                    <textarea name="notes" class="form-control" rows="5">{{$petition->notes}}</textarea>
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
                                            @endif
                        @endif
                    </div>
                </th>
            </tr>
        @endforeach
    </tbody>
</table>
