<h3 class="card-title float-sm-left"><a href="" class="btn btn-success" data-toggle="modal" data-target="#add-tab7">إضافة</a></h3>
<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>اسم الملف</th>
            <th>الوصف</th>
            <th>تحميل الملف</th>

            <th>ملاحظات</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($attachments as $index=>$row)
        <tr>
            <th>{{ $index + 1 }}</th>
            <th>{{$row->name}}</th>
            <th>{{$row->description}}</th>
            <th>
                <div class="btn-group">
                    <a  id="downloadCurrent" href="{{ asset('uploads/attachment')}}/{{$row->name}}" download="" class="btn btn-default"><i class="fas fa-download" title="download"></i>
                    {{-- <input type="text" name="attach" value="{{ asset('uploads/attachment')}}/{{$row->name}}" alt="{{$row->name}}" /> --}}
                </a>
                </div>
            </th>

            <th>{{$row->notes}}</th>
            <th>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#view-tab7{{$row->id}}"><i class="fas fa-eye" title="view"></i></button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#edit-tab7{{$row->id}}"><i class="fas fa-edit" title="edit"></i></button>
                    <button type="button" class="btn btn-default"><i class="fas fa-print" title="print"></i></button>
                    @can('cases-delete')
                    <button type="button" class="btn btn-default" data-toggle="modal"
                    data-target="#del7{{ $row->id }}"><i class="fas fa-trash-alt"></i></button>
                                     @endcan
                    </div>
                </th>
            </tr>
<!-- Delete Modal -->
<div class="modal fade dir-rtl" id="del7{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('attachment.destroy', $row->id) }}" method="POST">
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
 <!-- Edit Tab-7 Modal -->
 <div class="modal fade dir-rtl" id="edit-tab7{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات المرفقات</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-edit text-success"></i></h3>
                <form action="{{route('attachment.update',$row->id)}}" method="POST" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="case_id" value="{{$case->id}}">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">اضافة ملفات مرفقة</label>
                                    <div class="custom-file">
                                        <input type="file" name="name" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">{{$row->name}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>الوصف</label>
                                    <textarea name="description" class="form-control" rows="5">{{$row->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
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
<!-- View Tab-7 Modal -->
<div class="modal fade dir-rtl" id="view-tab7{{$row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">عرض بيانات المرفقات</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-edit text-success"></i></h3>
             <form>
                <input type="hidden" name="case_id" value="{{$case->id}}">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">اضافة ملفات مرفقة</label>
                                <div class="custom-file">
                                    <input type="file" name="name" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">{{$row->name}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>الوصف</label>
                                <textarea name="description" class="form-control" rows="5">{{$row->description}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
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



      <!-- Add Tab-7 Modal -->
      <div class="modal fade dir-rtl" id="add-tab7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form action="{{route('attachment.store')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="case_id" value="{{$case->id}}">
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
                                        <textarea  name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
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


