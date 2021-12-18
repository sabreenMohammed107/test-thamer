@extends('layout.web')
@section('title', 'المستخدمين')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> بيانات  المستخدمين</h3>
                <h3 class="card-title float-sm-left">
                    @can('users-create')
                    <a class="btn btn-success" href="{{ route('users.create') }}">إضافة</a>
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
   <th>البريد الإلكترونى</th>
   <th>الصلاحيه</th>
   <th width="280px">اجراءات</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
        <div class="btn-group">

       <a class="btn btn-default" href="{{ route('users.show',$user->id) }}"><i class="fas fa-eye" title="view"></i></a>
       <a class="btn btn-default" href="{{ route('users.edit',$user->id) }}"><i class="fas fa-edit" title="edit"></i></a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
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
