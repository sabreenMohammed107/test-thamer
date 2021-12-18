@extends('layout.web')

@section('title', 'الرئيسية')

@section('content')
<div class="container-fluid dir-rtl">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">

                <span class="info-box-icon bg-info elevation-1">
                          <a href="{{route('cases.index')}}">
                          <i class="fas fa-project-diagram"></i>
                        </a>
                        </span>

                <div class="info-box-content">
                    <a href="{{route('cases.index')}}">
                        <span class="info-box-text">القضايا</span>
                    </a>
                    <span class="info-box-number">
                {{$cases}}
              </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">

                <span class="info-box-icon bg-danger elevation-1">
                          <a href="{{route('un-finish')}}">
                          <i class="fas fa-tasks"></i>
                        </a>

                        </span>

                <div class="info-box-content">
                    <a href="{{route('un-finish')}}">
                        <span class="info-box-text">المهام غير المنجزة</span>
                    </a>
                    <span class="info-box-number"> {{$unfinsh}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1">
                      <a href="{{route('finish')}}">
                      <i class="fas fa-check"></i>
                    </a>
                  </span>
                <div class="info-box-content">
                    <a href="{{route('finish')}}">
                        <span class="info-box-text">المهام المنجزة</span>
                    </a>
                    <span class="info-box-number"> {{$finsh}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">

                <span class="info-box-icon bg-warning elevation-1">
                          <a href="{{route('court-comming')}}"><i class="fas fa-gavel"></i> </a></span>

                <div class="info-box-content">
                    <a href="{{route('court-comming')}}">
                        <span class="info-box-text">جلسات بالإنتظار</span>
                    </a>
                    <span class="info-box-number"> {{$commingSessions}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">

            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        {{-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1">
                      <a href="invoices.html">
                      <i class="fas fa-file-invoice-dollar"></i></a>
                    </span>
                <div class="info-box-content">
                    <a href="invoices.html">
                        <span class="info-box-text">الفواتير</span></a>
                    <span class="info-box-number">5</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div> --}}
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        {{-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1">
                      <a href="procedures.html">
                      <i class="fas fa-retweet"></i>
                    </a></span>
                <div class="info-box-content">
                    <a href="procedures.html">
                        <span class="info-box-text">الإجراءات</span></a>
                    <span class="info-box-number">6</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div> --}}
        <!-- /.col -->
        {{-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1">
                      <a href="dates.html">
                      <i class="fas fa-user-clock"></i>
                      </a>
                    </span>
                <div class="info-box-content">
                    <a href="dates.html">
                        <span class="info-box-text">المواعيد</span></a>
                    <span class="info-box-number">2</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div> --}}
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning elevation-1">
                      <a href="{{route('court-old')}}">
                      <i class="fas fa-folder"></i>
                    </a></span>
                <div class="info-box-content">
                    <a href="{{route('court-old')}}">
                        <span class="info-box-text">جلسات سابقة</span>
                    </a>
                    <span class="info-box-number">
                        {{$oldSessions}}
              </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1">
                      <a href="{{route('client')}}">
                      <i class="fas fa-users"></i>
                      </a></span>
                <div class="info-box-content">
                    <a href="{{route('client')}}">
                        <span class="info-box-text">العملاء</span></a>
                    <span class="info-box-number">
                        {{$clients}}
              </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
         <!-- /.col -->
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1">
                      <a href="{{route('users.index')}}">
                      <i class="fas fa-user-friends"></i>
                    </a></span>
                <div class="info-box-content">
                    <a href="{{route('users.index')}}">
                        <span class="info-box-text">المستخدمين</span></a>
                    <span class="info-box-number"> {{$users}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1">
                      <a href="{{route('Oppenont')}}">
                      <i class="fas fa-users"></i>
                    </a></span>
                <div class="info-box-content">
                    <a href="{{route('Oppenont')}}">
                        <span class="info-box-text">الخصوم</span></a>
                    <span class="info-box-number"> {{$oppont}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>


        <!-- /.col -->
    </div>
    {{-- <div class="col-md-6">
        <div class="form-group">
            <label>
                Default
            </label>
            <div class="input-group">
                <input type="text" class="form-control hijri-date-default" />
            </div>
        </div>
    </div> --}}
</div>
<!--/. container-fluid -->
@endsection


