@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> ملف القضية </h3>
                <h3 class="card-title float-sm-left">
                    إضافة بيانات الجلسة
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">


<!-- form start -->
<form role="form" action="{{ route('session.store') }}" method="post">
    @csrf
    <input type="hidden" name="case_id" value="{{ $case->id }}">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label> طلبات الجلسة </label>
                    <textarea id="mytextarea " name="text" class="form-control " rows="10"></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">تاريخ الجلسة </label>
                    <input type="text" autocomplete="off" value=""
                        class="form-control txt-rtl hijri-date-default-test" name="session_date"
                        class="form-control" id=""
                        placeholder=" ">

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">وقت الجلسة </label>
                    <input type="time" autocomplete="off" class="form-control"
                        name="session_time" id="inputEmail3"
                       >

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">رابط الجلسة </label>
                    <input type="text" autocomplete="off" class="form-control"
                        name="session_link" id="inputEmail3"
                       >

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">المكلف</label>
                    <select class="custom-select" name="member_id">
                        @foreach ($users as $type)
                            <option {{ Auth::user()->id == $type->id ? 'selected' : '' }}
                                value="{{ $type->id }}">
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>تقرير الجلسة </label>
                    <textarea name="notes" class="form-control" rows="5"></textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-success">تأكيد</button>
    </div>
</form>
{{-- End Form --}}


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        @endsection

