@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> سجل العملاء</h3>
                <h3 class="card-title float-sm-left">

                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">



                <div class="card-body" id="preIndex">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>رقم الهوية</th>
                                <th>اسم العميل</th>
                                <th>رقم الجوال</th>
                                <th>البريد الالكتروني</th>
                                <th>عرض</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $row)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <th>{{$row->identity_no}}</th>
                                <th>{{$row->name}}</th>
                                <th>{{$row->mobile}}</th>
                                <th>{{$row->email}}</th>
                                <th>
                                    <div class="btn-group">
                                        @can('cases-list')
                                        <a href="{{url('show-client', $row->id) }}" class="btn btn-default"><i class="fas fa-eye" title="view"></i></a>
                                        @endcan

                                    </div>
                                </th>
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
