<h3 class="card-title float-sm-left"><a href="" class="btn btn-success" data-toggle="modal"
        data-target="#add-tab6">إضافة</a></h3>
<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>اسم المحكمة</th>
            <th>تاريخ الجلسة </th>
            <th>الزميل المكلف</th>
            <th>ملاحظات</th>
            <th>انجاز</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sessions as $index => $row)
            <tr>
                <th>{{ $index + 1 }}</th>
                <th>{{ $row->text }}</th>
                <th>{{ date('Y/m/d', strtotime($row->session_date)) }}</th>
                <th>{{ $row->member->name ?? '' }}</th>
                <th>{{ $row->notes }}</th>
                <th>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#done"><i
                                class="fas fa-check" title="view"></i></button>
                    </div>
                </th>
                <th>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-toggle="modal"
                            data-target="#view-tab6{{ $row->id }}"><i class="fas fa-eye"
                                title="view"></i></button>
                        <button type="button" class="btn btn-default" data-toggle="modal"
                            data-target="#edit-tab6{{ $row->id }}"><i class="fas fa-edit"
                                title="edit"></i></button>
                        {{-- <button type="button" class="btn btn-default"><i class="fas fa-print" title="print"></i></button> --}}
                        @can('cases-delete')
                    <button type="button" class="btn btn-default" data-toggle="modal"
                    data-target="#del6{{$row->id}}"><i class="fas fa-trash-alt"></i></button>
                                     @endcan
                    </div>
                </th>
            </tr>
<!-- Delete Modal -->
<div class="modal fade dir-rtl" id="del6{{$row->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('session.destroy', $row->id) }}" method="POST">
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
            <!-- Edit Tab-6 Modal -->
            <div class="modal fade dir-rtl" id="edit-tab6{{ $row->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات الجلسات </h5>
                            <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h3><i class="fas fa-edit text-success"></i></h3>
                            <form role="form" action="{{ route('session.update', $row->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="case_id" value="{{ $case->id }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>نص الجلسة </label>
                                                <textarea name="text" class="form-control "
                                                    rows="10">{{ $row->text }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">تاريخ الجلسة </label>
                                                <input type="text" class="form-control txt-rtl hijri-date-default"
                                                    value="" name="session_date" id="inputEmail3"
                                                    placeholder="{{ date('d-m-Y', strtotime($row->session_date)) }}">

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">الزميل المكلف</label>
                                                <select class="custom-select dynamic" name="member_id" id="member_id">
                                                    <option>اختر </option>

                                                    @foreach ($users as $type)
                                                        <option {{ $row->member_id == $type->id ? 'selected' : '' }}
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
                                                    rows="5">{{ $row->notes }}</textarea>
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
            <!-- View Tab-6 Modal -->
            <div class="modal fade dir-rtl" id="view-tab6{{ $row->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLabel">عرض بيانات الجلسات </h5>
                            <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h3><i class="fas fa-edit text-success"></i></h3>
                            <form role="form">
                                <input type="hidden" name="case_id" value="{{ $case->id }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>نص الجلسة </label>
                                                <textarea name="text" class="form-control "
                                                    rows="10">{{ $row->text }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">تاريخ الجلسة </label>
                                                <input type="text" class="form-control txt-rtl hijri-date-default"
                                                    value="" name="session_date" id="inputEmail3"
                                                    placeholder="{{ date('d-m-Y', strtotime($row->session_date)) }}">

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">الزميل المكلف</label>
                                                <select class="custom-select dynamic" name="member_id" id="member_id">
                                                    <option>اختر </option>

                                                    @foreach ($users as $type)
                                                        <option {{ $row->member_id == $type->id ? 'selected' : '' }}
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
                                                    rows="5">{{ $row->notes }}</textarea>
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

<!-- Add Tab-6 Modal -->
<div class="modal fade dir-rtl" id="add-tab6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                    <label>ضبط الجلسة </label>
                                    <textarea id="mytextarea " name="text" class="form-control " rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">تاريخ الجلسة </label>
                                    <input type="text" value="" class="form-control txt-rtl hijri-date-default"
                                        name="session_date" class="form-control" id="">

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
