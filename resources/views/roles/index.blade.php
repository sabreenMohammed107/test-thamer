@extends('layout.web')
@section('title', 'الأدوار')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> بيانات أدوار المستخدمين</h3>
                <h3 class="card-title float-sm-left">
                    @can('roles-create')
                    <a class="btn btn-success" href="{{ route('roles.create') }}">إضافة</a>
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
     <th width="280px">الإجراءات</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-default" href="{{ route('roles.show',$role->id) }}"><i class="fas fa-eye" title="view"></i></a>

            @can('roles-edit')
            <a class="btn btn-default" href="{{ route('roles.edit',$role->id) }}"><i class="fas fa-edit" title="edit"></i></a>

            @endcan
            @can('roles-delete')
            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
            {{-- {!! Form::submit('Delete', ['class' => 'btn btn-default']) !!} --}}
            {{ Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-default'] )  }}

            {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{{-- {!! $roles->render() !!} --}}



</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
@endsection
