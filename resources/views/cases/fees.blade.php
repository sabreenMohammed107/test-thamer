<h3 class="card-title float-sm-left"><a href="" class="btn btn-success" data-toggle="modal" data-target="#add-tab8">إضافة</a></h3>
<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>تاريخ الدفعة</th>
            <th>القيمة</th>
            <th>تم دفعها</th>
            <th>ملاحظات</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fees as $index=>$row)
        <tr>
            <th>{{ $index + 1 }}</th>
            <th>{{date('Y/m/d', strtotime($row->installment_date))}} </th>
            <th>{{$row->pay_amount}}</th>
            <th>@if($row->paid==1)<i class="fas fa-check" title="view"></i> @else <i class="fas fa-times" title="view"></i> @endif</th>
            <th>{{$row->notes}}</th>
            <th>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#view-tab8{{$row->id}}"><i class="fas fa-eye" title="view"></i></button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#edit-tab8{{$row->id}}"><i class="fas fa-edit" title="edit"></i></button>
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
        <form action="{{ route('fees.destroy', $row->id) }}" method="POST">
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
 <!-- Edit Tab-8 Modal -->
 <div class="modal fade dir-rtl" id="edit-tab8{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات دفعات الأتعاب</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fas fa-edit text-success"></i></h3>
                <form role="form" action="{{ route('fees.update',$row->id) }}"
                    method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="case_id" value="{{$case->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="paid" id="checkboxPrimary1" @if($row->paid==1) checked @endif>
                                        <label for="checkboxPrimary1">
                                            تم دفعها
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>تاريخ الدفعة </label>
                                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                    value=""
                                    name="installment_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($row->installment_date)) }}">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label> القيمة </label>
                                    <input type="number" name="pay_amount" value="{{$row->pay_amount}}" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ملاحظات </label>
                                    <textarea class="form-control" name="notes" rows="5">{{$row->notes}}</textarea>
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
<!-- View Tab-8 Modal -->
<div class="modal fade dir-rtl" id="view-tab8{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">عرض بيانات دفعات الأتعاب</h5>
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
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="paid" id="checkboxPrimary1" @if($row->paid==1) checked @endif>
                                        <label for="checkboxPrimary1">
                                            تم دفعها
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>تاريخ الدفعة </label>
                                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default"
                                    value=""
                                    name="installment_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($row->installment_date)) }}">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label> القيمة </label>
                                    <input type="number" name="pay_amount" value="{{$row->pay_amount}}" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ملاحظات </label>
                                    <textarea class="form-control" name="notes" rows="5">{{$row->notes}}</textarea>
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



      <!-- Add Tab-8 Modal -->
      <div class="modal fade dir-rtl" id="add-tab8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة بيانات دفعات الأتعاب</h5>
                    <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h3><i class="fas fa-edit text-success"></i></h3>
                    <form role="form" action="{{route('fees.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="case_id" value="{{$case->id}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="paid" id="checkboxPrimary1">
                                            <label for="checkboxPrimary1">
                                                تم دفعها
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>تاريخ الدفعة </label>
                                        <input type="text" autocomplete="off" value=""
                                        class="form-control txt-rtl hijri-date-default" name="installment_date" class="form-control" id="">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> القيمة </label>
                                        <input type="number" name="pay_amount" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ملاحظات </label>
                                        <textarea class="form-control" name="notes" rows="5"></textarea>
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

