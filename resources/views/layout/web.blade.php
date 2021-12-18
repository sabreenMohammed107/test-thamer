@include('layout.head')

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed dark-mode text-sm">
    <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light dir-rtl">
                <!-- right navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="index3.html" class="nav-link">الرئيسية</a>
                    </li>
                </ul>


                <!-- left navbar links -->
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-left text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-left text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-left text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                class="fas fa-th-large"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            {{-- <div class="image">
                                <img src="{{ asset('webassets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" style="width: 30px" alt="User Image">
                            </div> --}}
                            <p> مرحبا {{Auth::user()->name}} </p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                            <span class="dropdown-item dropdown-header">{{Auth::user()->name}}</span>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('edit-user-profile/'.Auth::user()->id) }}" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i>تعديل بينات المستخدم
                            </a>
                            <div class="dropdown-divider"></div>
                            <a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> تسجيل خروج
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->


    @include('layout.header')

    <!-- container -->

   <!-- container -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 dir-rtl">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('title')</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                       @yield('crumb')
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

         <!-- Main content -->
         <section class="content ">
            <div class="container-fluid dir-rtl ">
                @include('layout.messages')

                @yield('content')
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@yield('modal')



@include('layout.footer')

@include('layout.footerScripts')
