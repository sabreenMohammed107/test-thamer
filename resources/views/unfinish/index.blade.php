@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> مهام غير مكتمله</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th> القضية</th>
                            <th> رقم القضية</th>
                            <th>العميل</th>

                            <th>تاريخ التكليف</th>
                            <th>تاريخ الإنتهاء</th>
                            <th>المكلف بها</th>
                            <th>ملاحظات </th>
                            <th>الحاله </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $yesterday = Carbon\Carbon::yesterday();
                        $today = Carbon\Carbon::tomorrow();
                        ?>
                        @foreach ($unfinsh as $index => $row)
                        <tr class=" @if($row->end_date > $yesterday && $row->end_date <= $today) text-danger @elseif ($row->end_date < $yesterday) text-white @else text-warning @endif "
                   >
                            <th>{{ $index + 1 }}</th>
                        {{-- <tr class="text-warning"> --}}

                            <th> {{ $row->case->name ?? '' }}</th>
                            <th>{{ $row->case->file_no ?? ''}}</th>
                            <th>{{ $row->case->client->name ?? ''}}</th>

                            <th>{{ date('Y/m/d', strtotime($row->task_date)) }}</th>
                            <th>{{ date('Y/m/d', strtotime($row->end_date)) }}</th>
                            <th>{{ $row->member->name ?? '' }}</th>
                            <th>{{ $row->notes}} </th>
                            <th>@if($row->end_date > $yesterday && $row->end_date <= $today) اوشكت تنتهى @elseif ($row->end_date < $yesterday) انتهت @else لم تنتهى @endif </th>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
        @endsection
