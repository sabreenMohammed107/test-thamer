@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">جلسات بالإنتظار
                    </h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>أيام تبقيه</th>
                                <th>تاريخ الجلسة </th>
                                <th>وقت الجلسة</th>
                                <th> القضية</th>
                                <th> المحكمة </th>

                                <th>المكلف </th>
                                <th>معلومات عن الجلسة </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $date = Carbon\Carbon::now()->addMonth();
                            Alkoumi\LaravelHijriDate\Hijri::Date('l ، j F ، Y', $date);
                            $nowHijri = Alkoumi\LaravelHijriDate\Hijri::Date('Y/m/d');
                            ?>
                            @foreach ($commingSessions as $index => $row)
                                <tr class="bg-light">
                                    <th>{{ $index + 1 }}</th>
                                    <?php
                                    $remaining_days = Carbon\Carbon::parse($nowHijri)->diffInDays(Carbon\Carbon::parse($row->session_date));
                                    ?>
                                    <th>{{ $remaining_days }}</th>
                                    <th>{{ date('Y/m/d', strtotime($row->session_date)) }}</th>
                                    <th>{{ $row->session_time ?? '' }}</th>
                                    <th> {{ $row->case->name ?? '' }}</th>
                                    <th>{{ $row->case->court->name ?? '' }}</th>
                                    <th>{{ $row->member->name ?? '' }}</th>
                                    <th> {{ $row->text }}</th>

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
