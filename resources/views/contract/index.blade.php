@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> العقود</h3>
                <h3 class="card-title float-sm-left">
                    @can('cases-create')
                    <a class="btn btn-success" href="{{ route('contract.create') }}">إضافة</a>
                    @endcan
                </h3>
            </div>
             <!-- /.card-header -->
             <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> نوع العقد</th>
                            <th>الطرف الأول</th>
                            <th>الطرف الثانى</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $index => $row)
        <tr>
            <th>{{ $index + 1 }}</th>
                            <th> {{$row->type->type?? ''}}</th>
                            <th>{{$row->firstSide->name?? ''}}</th>
                            <th>{{$row->secondSide->name?? ''}}</th>
                            <th>
                                <a href="{{ route('contract.edit', $row->id) }}" class="btn btn-default"><i
                                    class="fas fa-edit" title="edit"></i></a>
                                <a href="{{ route('contract.show', $row->id) }}" target="_blank" class="btn btn-default"><i
                                    class="fas fa-eye" title="view"></i></a>
                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#del{{ $row->id }}"><i class="fas fa-trash-alt"></i></button>
                                </th>
                        </tr>
                          <!-- Delete Modal -->
            <div class="modal fade dir-rtl" id="del{{ $row->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('contract.destroy', $row->id) }}" method="POST">
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
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@section('scripts')
 <!-- DataTables -->
 <script src="{{ asset('webassets/plugins/datatables/jquery.dataTables.js')}}"></script>
 <script src="{{ asset('webassets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });

</script>
@endsection
