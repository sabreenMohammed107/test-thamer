@extends('layout.web')
@section('title', 'التقارير')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> بيانات  التقارير</h3>
                <h3 class="card-title float-sm-left">
                    @can('users-create')
                    <a class="btn btn-success" href="{{ route('caseCreateReport', $case->id) }}">إضافة</a>
                    @endcan
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead >
 <tr>
   <th>#</th>
   <th>التقرير</th>
   <th>التاريخ</th>
   <th width="280px">اجراءات</th>
 </tr>
 @foreach ($reports as $key => $court)
  <tr>
    <td>{{ ++$key }}</td>
    <td>{{ $court->text }}</td>
    <td>{{ date('Y/m/d', strtotime($court->report_date)) }}</td>

    <td>
        <div class="btn-group">

       <a class="btn btn-default" href="{{ route('caseEditReport',$court->id) }}"><i class="fas fa-edit" title="edit"></i></a>
        {!! Form::open(['method' => 'DELETE','route' => ['caseDeleteReport', $court->id],'style'=>'display:inline']) !!}
            {{-- {!! Form::submit('Delete', ['class' => 'btn btn-default']) !!} --}}
            {{ Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-default'] )  }}

            {!! Form::close() !!}
        </div>
    </td>
  </tr>
 @endforeach
</table>


{{-- {!! $data->render() !!} --}}

</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->

@endsection
