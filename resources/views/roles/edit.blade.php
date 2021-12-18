@extends('layout.web')

@section('title', 'الصلاحيات')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> بيانات صلاحيات المستخدمين</h3>
                <h3 class="card-title float-sm-left">
                    {{-- @can('roles-create') --}}
                    {{-- <a class="btn btn-success" href="{{ route('users.create') }}">إضافة</a> --}}
                    {{-- @endcan --}}
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">



{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الاسم:</strong>
            {!! Form::text('name', null, array('placeholder' => 'الاسم','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الصلاحية:</strong>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{route('roles.index')}}" class="btn btn-danger">إلغاء</a>
    </div>
</div>
{!! Form::close() !!}


@endsection
