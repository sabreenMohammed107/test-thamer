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


{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
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
                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{-- {{ $value->name }} --}}
                {{$value->id==1 ?'قائمه الصلاحيات':''}}
                {{$value->id==2 ?'اضافة الصلاحيات':''}}
                {{$value->id==3 ?'تعديل الصلاحيات':''}}
                {{$value->id==4 ?'حذف الصلاحيات':''}}
                {{$value->id==5 ?'قائمه المستخدمين':''}}
                {{$value->id==6 ?'اضافة المستخدمين':''}}
                {{$value->id==7 ?'تعديل المستخدمين':''}}
                {{$value->id==8 ?'حذف المستخدمين':''}}
                {{$value->id==9 ?'قائمه القضايا':''}}
                {{$value->id==10 ?'اضافة القضايا':''}}
                {{$value->id==11 ?'تعديل القضايا':''}}
                {{$value->id==12 ?'حذف القضايا':''}}
            </label>
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
