@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> مهام  مكتمله</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>اسم القضية</th>
                            <th>رقم القضية</th>
                            <th>العميل</th>
                            <th>تاريخ التكليف</th>
                            <th>تاريخ انتهاء</th>
                            <th>المكلف بها</th>
                            <th>النوع</th>
                            <th>ملاحظات </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finsh as $index => $row)
                        <tr class="">
                            <th>{{ $index + 1 }}</th>
                        {{-- <tr class="text-warning"> --}}

                            <th> {{ $row->case->name ?? '' }}</th>
                            <th>{{ $row->case->file_no ?? ''}}</th>
                            <th>{{ $row->case->client->name ?? ''}}</th>

                            <th>{{ date('Y/m/d', strtotime($row->task_date)) }}</th>
                            <th>{{ date('Y/m/d', strtotime($row->end_date)) }}</th>
                            <th>
                                @if ($row->task_type_id == 7)
                                {{ $row->transfer->name ?? '' }}
                            @else
                                {{ $row->member->name ?? '' }}
                            @endif
                                </th>
                            <th>{{ $row->task_description}} </th>
                            <th>{{ $row->notes}} </th>
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
