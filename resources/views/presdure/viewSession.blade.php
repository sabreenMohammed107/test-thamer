@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> ملف القضية </h3>
                <h3 class="card-title float-sm-left">

                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">


<!-- form start -->
<form role="form" action="{{ route('session.update', $session->id) }}" method="post">
    @method('PUT')
    @csrf
    <input type="hidden" name="case_id" value="{{ $session->case_id }}">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>طلبات الجلسة </label>
                    <textarea name="text" class="form-control "
                        rows="10">{{ $session->text }}</textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">تاريخ الجلسة </label>
                    <input type="text" autocomplete="off" class="form-control txt-rtl hijri-date-default-test"
                        value="" name="session_date" id="inputEmail3"
                        placeholder="{{ date('d-m-Y', strtotime($session->session_date)) }}">

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">المكلف</label>
                    <select class="custom-select dynamic" name="member_id" id="member_id">
                        <option>اختر </option>

                        @foreach ($users as $type)
                            <option {{ $session->member_id == $type->id ? 'selected' : '' }}
                                value="{{ $type->id }}">
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>تقرير الجلسة </label>
                    <textarea name="notes" class="form-control"
                        rows="5">{{ $session->notes }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="modal-footer">
        <a href="{{route('cases.show', $session->case_id) }}" class="btn btn-secondary">إلغاء</a>
        {{-- <button type="submit" class="btn btn-success">تأكيد</button> --}}
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
