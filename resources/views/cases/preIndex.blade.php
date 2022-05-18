<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-light">
        <tr>
            <th>#</th>
            <th> القضيه</th>
            <th>الوصف</th>
            <th>اسم العميل </th>
            <th>تاريخ بداية القضية</th>
            <th>رقم الملف</th>
            <th>الفرع</th>
            <th>الاجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $row)
        <tr>
            <th>{{ $index + 1 }}</th>
            <th><a href="{{route('cases.show',$row->id)}}">{{ $row->name }}</a></th>
            <th>{{ $row->notes }}</th>
            <th>{{ $row->client->name ?? ''}}</th>
            <th>{{ date('Y/m/d', strtotime($row->start_date)) }} </th>
            <th>{{ $row->file_no }}</th>
            <th>{{ $row->branch->name ?? '' }}</th>
            <th>
                <div class="btn-group">
                    @can('cases-list')
                    <a href="{{route('cases.show', $row->id) }}" class="btn btn-default"><i class="fas fa-eye" title="view"></i></a>
                    @endcan
                    @can('cases-edit')
                    <a href="{{route('cases.edit', $row->id) }}" class="btn btn-default"><i class="fas fa-edit" title="edit"></i></a>
                    @endcan
                    @can('cases-delete')
                    <button type="button" class="btn btn-default" data-toggle="modal"
                    data-target="#del{{ $row->id }}"><i class="fas fa-trash-alt"></i></button>
                                     @endcan

                                     @can('cases-edit')
                                     <a href="{{route('caseReport', $row->id) }}" class="btn btn-default"><i class="fa fa-file" title="report"></i></a>
                                     @endcan
                </div>
            </th>
        </tr>
<!-- Delete Modal -->
<div class="modal fade dir-rtl" id="del{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('cases.destroy', $row->id) }}" method="POST">
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
       @endforeach



    </tbody>
</table>
