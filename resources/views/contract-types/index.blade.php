@extends('layout.web')
@section('title', 'انواع العقود')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> انواع العقود  </h3>
                <h3 class="card-title float-sm-left">
                    @can('users-create')
                    <a class="btn btn-success" href="{{ route('contract-types.create') }}">إضافة</a>
                    @endcan
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead >
 <tr>
   <th>#</th>
   <th>الاسم</th>

   <th width="280px">اجراءات</th>
 </tr>
 @foreach ($data as $key => $contType)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $contType->type }}</td>

    <td>
        <div class="btn-group">

       <a class="btn btn-default" href="{{ route('contract-types.edit',$contType->id) }}"><i class="fas fa-edit" title="edit"></i></a>
        {!! Form::open(['method' => 'DELETE','route' => ['contract-types.destroy', $contType->id],'style'=>'display:inline']) !!}
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
