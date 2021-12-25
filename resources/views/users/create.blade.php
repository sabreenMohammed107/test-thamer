@extends('layout.web')

@section('title', 'المستخدمين')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> بيانات  المستخدمين</h3>
                <h3 class="card-title float-sm-left">
                    {{-- @can('roles-create') --}}
                    {{-- <a class="btn btn-success" href="{{ route('users.create') }}">إضافة</a> --}}
                    {{-- @endcan --}}
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الاسم:</strong>
            {!! Form::text('name', null, array('placeholder' => 'الاسم','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>رقم الهوية:</strong>
            {!! Form::text('n_id', null, array('placeholder' => 'رقم الهوية','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>البريد الالكتروني:</strong>
            {!! Form::text('email', null, array('placeholder' => 'البريد الالكتروني','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>كلمة المرور:</strong>
            {!! Form::password('password', array('placeholder' => 'كلمة المرور','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>تأكيد كلمة المرور:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'تأكيد كلمة المرور','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الفرع:</strong>
            {{-- {!! Form::select('branches[]', $branches,[], array('class' => 'form-control ','multiple')) !!} --}}
            <select class="form-control" id="branches" name="branches[]" multiple>
                @foreach ($branches as $branch)
                <option value="{{$branch->id}}">{{$branch->name}}</option>
                @endforeach
               </select>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الصلاحية:</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
        </div>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{route('users.index')}}" class="btn btn-danger">إلغاء</a>

    </div>
</div>
{!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
