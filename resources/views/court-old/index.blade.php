@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">جلسات السابقة
                    </h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>تاريخ الجلسة </th>
                                <th> القضية</th>
                                <th> المحكمة </th>

                                <th>المكلف </th>
                                <th>معلومات عن الجلسة </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($oldSessions as $index => $row)
                                <tr class="">
                                    <th>{{ $index + 1 }}</th>

                                    <th>{{ date('Y/m/d', strtotime($row->session_date)) }}</th>
                                    <th> {{$row->case->name ?? '' }}</th>
                                    <th>{{ $row->case->court->name ?? '' }}</th>
                                    <th>{{ $row->member->name ?? '' }}</th>
                                    <th> {{ $row->text}}</th>

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
