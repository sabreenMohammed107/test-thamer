
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
<form role="form" action="{{ route('memberReferral') }}" method="post">
    @csrf
    <input type="hidden" name="case_id" value="{{ $prosed->case_id }}">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">المكلف</label>
                    <select class="custom-select" name="transfer_case_id ">
                        @foreach ($users as $type)
                            <option {{ $prosed->transfer_case_id  == $type->id ? 'selected' : '' }}
                                value="{{ $type->id }}">
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">تاريخ الإحالة </label>
                    <input type="text" readonly value="{{$prosed->end_date}}" name="incharge_date">

                    {{-- <input type="text" autocomplete="off" value=""
                        class="form-control txt-rtl hijri-date-default" name="incharge_date"
                        class="form-control" id="" placeholder="@if ($prosed){{ date('d-m-Y', strtotime($prosed->end_date)) }}@endif" > --}}

                </div>
            </div>
            <?php
            $member=App\Models\Case_members::where('member_id',$prosed->transfer_case_id)->where('case_id',$prosed->case_id)->first();
            ?>
            <div class="col-sm-6">
                {{-- <div class="form-group">
                    <label for="">وقت الإحالة </label>
                    <input type="time" id="appt" name="referral"
                    min="09:00" max="18:00" value="{{$member->referral}}"
                        class="form-control"
                        >

                </div>
            </div> --}}



            <div class="col-sm-12">
                <div class="form-group">
                    <label>سبب الإحالة </label>
                    <textarea name="reason"  class="form-control" rows="5">{{$member->reason}}</textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="modal-footer">
      <a  href="{{route('cases.show', $prosed->case_id) }}" class="btn btn-secondary">إلغاء</a>
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
