@extends('layout.web')

@section('title', 'تقارير ')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> اضافة  تقرير</h3>
                <h3 class="card-title float-sm-left">

                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


<form action="{{route('caseStoreReport')}}" method="post" >
    @csrf
<div class="row">
    <input type="hidden" value="{{$case->id}}" name="case_id" >
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">تاريخ بدايه القضيه </label>
            <input type="text"
                value="dd-mm-YYYY"
                name="report_date"
                autocomplete="off"
                class="form-control txt-rtl hijri-date-default"
                id="">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label for="">التقرير</label>
            <textarea class="form-control"
                name="text"
                rows="3">{{ old('text') }}</textarea>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{route('caseReport',$case->id)}}" class="btn btn-danger">إلغاء</a>

    </div>
</div>
</form>
            </div>
        </div>
    </div>
</div>
@endsection
