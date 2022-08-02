@extends('layout.web')

@section('title', 'انواع العقود')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">  اضافة نةع جديد  </h3>
                <h3 class="card-title float-sm-left">

                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


{!! Form::open(array('route' => 'contract-types.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>النوع :</strong>
            {!! Form::text('type', null, array('placeholder' => 'النوع','class' => 'form-control')) !!}
        </div>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{route('contract-types.index')}}" class="btn btn-danger">إلغاء</a>

    </div>
</div>
{!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
