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

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الاسم:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الصلاحية:</strong><br><br>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }}</label><br>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <a href="{{route('roles.index')}}" class="btn btn-danger">إلغاء</a>
    </div>
</div>
@endsection
