@extends('layout.web')
@section('title', 'المحاكم')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> بيانات  المحاكم</h3>
                <h3 class="card-title float-sm-left">
                    @can('users-create')
                    <a class="btn btn-success" href="{{ route('courts.create') }}">إضافة</a>
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
 @foreach ($data as $key => $court)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $court->name }}</td>

    <td>
        <div class="btn-group">

       <a class="btn btn-default" href="{{ route('courts.edit',$user->id) }}"><i class="fas fa-edit" title="edit"></i></a>
        {!! Form::open(['method' => 'DELETE','route' => ['courts.destroy', $user->id],'style'=>'display:inline']) !!}
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
