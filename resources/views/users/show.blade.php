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

<div class="row ">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الاسم:</strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>رقم الهويه:</strong>
            {{ $user->n_id }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>البريد الإلكتروني:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الفروع:</strong>
            @if(!empty($userBranch))
                @foreach($userBranch as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الصلاحية:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 text-center">

    <a href="{{route('users.index')}}" class="btn btn-danger">إلغاء</a>

</div>
            </div>
        </div>
@endsection
