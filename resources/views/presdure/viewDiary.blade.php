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
<form role="form" action="{{ route('diary.update',$diary->id) }}"
    method="post">
    @method('PUT')
    @csrf
    <input type="hidden" name="case_id" value="{{$diary->case_id}}">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label> الكليشة</label>
                    <input name="title" class="form-control "
                        rows="5" value="{{$diary->title}}">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>نص المذكرة</label>
                    <textarea  name="text" readonly class="form-control " rows="5">{{$diary->text}}</textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">تاريخ المذكرة</label>
                    <input type="text" readonly autocomplete="off" class="form-control txt-rtl hijri-date-default"
                    value=""
                    name="diary_date" id="inputEmail3" placeholder="{{ date('d-m-Y', strtotime($diary->diary_date)) }}">

                </div>
            </div>
            <?php
            $task=App\Models\Case_members_task::where('diary_id',$diary->id)->first();
            ?>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">تاريخ التسليم </label>
                    <input type="text" readonly autocomplete="off" class="form-control txt-rtl hijri-date-default"
                    value=  ""
                    name="diary_end_date" id="inputEmail3" placeholder="@if($task){{ date('d-m-Y', strtotime($task->end_date))}}@endif">
                                                   </div>
            </div>


            <div class="col-sm-12">
                <div class="form-group">
                    <label>ملاحظات </label>
                    <textarea name="notes" readonly class="form-control" rows="5"> {{$diary->notes}} </textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="modal-footer">

        <a href="{{route('cases.show', $diary->case_id) }}" class="btn btn-secondary">إلغاء</a>

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
