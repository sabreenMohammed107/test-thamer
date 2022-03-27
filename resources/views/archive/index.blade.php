@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> القضايا</h3>
                <h3 class="card-title float-sm-left">

                </h3>
            </div>
            <!-- /.card-header -->




                <div class="card-body" >
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>اسم القضيه</th>
                                <th>الوصف</th>
                                <th>اسم العميل </th>
                                <th>تاريخ بداية القضية</th>
                                <th>رقم الملف</th>
                                <th>الفرع</th>
                                <th>الاجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $row)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <th><a href="{{route('archive.show',$row->id)}}">{{ $row->name }}</a></th>
                                <th>{{ $row->notes }}</th>
                                <th>{{ $row->client->name ?? ''}}</th>
                                <th>{{ date('Y/m/d', strtotime($row->start_date)) }} </th>
                                <th>{{ $row->file_no }}</th>
                                <th>{{ $row->branch->name ?? '' }}</th>
                                <th>
                                    <div class="btn-group">
                                        @can('cases-list')
                                        <a href="{{route('archive.show', $row->id) }}" class="btn btn-default"><i class="fas fa-eye" title="view"></i></a>
                                        @endcan

                                    </div>
                                </th>
                            </tr>

                           @endforeach



                        </tbody>
                    </table>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        @endsection
        @section('scripts')
        <script>



            // end ready
        </script>
        @endsection
