@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> قضايا التنفيذ</h3>
                <h3 class="card-title float-sm-left">

                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">


<!-- form start -->
<form role="form">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">الزميل المكلف</label>
                    <input type="text" class="form-control" id="" value="{{$member->member->name ?? ''}}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">اسم القضيه</label>
                    <input type="text" class="form-control" id="" value="{{$row->name }}">

                </div>
            </div>
            @hasrole('Admin')
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">مبلغ المطالبه</label>
                    <input type="text" class="form-control" id="" value="{{$row->case_fees}}">
                </div>
            </div>
            @endhasrole
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">العميل</label>
                    <input type="text" class="form-control" id="" value="{{$row->client->name ?? ''}}">

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">الخصم</label>
                    <input type="text" class="form-control" id="" value="{{$row->oppon->name ?? ''}}">

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for=""> ملفات مرفقة</label>
                    <?php
                    $attachment=App\Models\Attachment::where('case_id',$row->id)->get();
                    $count = $attachment->count();
                    ?>
                    <div class="custom-file">
                        <label for="">عدد الملفات</label>
                    <input type="text" class="form-control" id="" readonly value="{{$count}}">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        {{-- <button type="submit" class="btn btn-primary">رجوع</button> --}}
        <a href="{{ route('dision') }}"
        class="btn btn-danger">إلغاء</a>
    </div>
</form>


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        @endsection
