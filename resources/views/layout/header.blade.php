    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('home')}}" class="brand-link">
            {{-- <img src="{{ asset('webassets/dist/img/zz.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
            <p class="brand-text font-weight-light ml-3" style="font-size: 20px">ثامر بن ساري العنزي</p>
            {{-- <p class="m-0 text-dark">ثامر بن ساري العنزي</p> --}}
        </a>

        <!-- Sidebar -->
        <div class="sidebar dir-rtl">
            <!-- Sidebar user panel (optional) -->
            {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('webassets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('home')}}" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div> --}}

            <div class="user-panel" style="background: #fff">
                <img src="{{ asset('webassets/dist/img/bg.jpeg')}}" style="width:100%;height:150px" alt="User Image" />

            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2 dir-rtl">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="{{route('home')}}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                الرئيسية
                            </p>
                        </a>

                    </li>
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                إدارة المهام
                                <i class="fas fa-angle-right left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview">
                                <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        قائمة الأعمال
                                        <i class="left fas fa-angle-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    {{-- @can('cases-list') --}}

                                    <li class="nav-item">
                                        <a href="{{route('cases.index')}}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>قضايا </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('contract.index')}}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>عقود</p>
                                        </a>
                                    </li>
                                    {{-- @endcan --}}
                                   <!-- <li class="nav-item">
                                        <a href="consultation.html" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>استشارات</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="contract.html" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>عقود</p>
                                        </a>
                                    </li>-->
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('courts.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>المحاكم</p>
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('un-finish')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>المهام غير المنجزة</p>
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('finish')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>المهام المنجزة</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('court-comming')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>جلسات بالأنتظار</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('court-old')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>جلسات سابقة</p>
                                </a>
                            </li>
                            <!--<li class="nav-item">
                    <a href="procedures.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>سجل الاجراءت</p>
                    </a>
                </li>-->
                            <li class="nav-item">
                                <a href="{{route('dision')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>قضايا التنفيذ</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('client')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>سجل العملاء</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('Oppenont')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>سجل الخصوم</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                   <!-- <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                الفواتير
                                <i class="fas fa-angle-right left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="invoices.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>الفواتير</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="payment-permissions.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>أذونات الدفع</p>
                                </a>
                            </li>

                            <li class="nav-item">
            <a href="price-offers.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>عرض السعر</p>
            </a>
          </li>-->
                            <!--<li class="nav-item">
            <a href="items.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>الأصناف</p>
            </a>
          </li>
                        </ul>
                    </li>-->
                   <!-- <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                أرشيف المكتب
                                <i class="left fas fa-angle-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="archive-sections.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>أقسام الأرشيف</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>
                                المواعيد
                                <i class="fas fa-angle-right left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="dates.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>مواعيد في الإنتظار</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                الاستعارات
                                <i class="fas fa-angle-right left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="documents-list.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>تسجيل الوثائق</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                المكتبة القانونية
                                <i class="fas fa-angle-right left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="https://nezams.com/" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>البحث</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>
                                الشؤون الإدارية
                                <i class="fas fa-angle-right left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="treasury.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>الخزينة</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="employees.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>سجل الموظفين</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="finances.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>سجل طلبات الصرف</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="vacations.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>سجل الاجازات</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="permits.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>سجل الاؤذنات</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="approval-requests.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>الموافقة على الطلبات</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                المعاملات
                                <i class="fas fa-angle-right left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="outgoing.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>سجل الصادر</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="incoming.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>سجل الوارد</p>
                                </a>
                            </li>
                        </ul>
                    </li>-->
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                أرشيف المكتب
                                <i class="left fas fa-angle-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('archive.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>قضايا الأرشيف</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                              المستخدمين
                                <i class="fas fa-angle-right left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('users.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>قائمه المستخدمين</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p>
                                الصلاحيات
                                <i class="fas fa-angle-right left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{-- @can('roles-list') --}}
                            <li class="nav-item">
                                <a href="{{route('roles.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> قائمه الصلاحيات</p>
                                </a>
                            </li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    <!--<li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                الإعدادات
                                <i class="fas fa-angle-right left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="basic-information.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> البيانات المستخدمة</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="system-setting.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>أعدادات النظام </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="support.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>الدعم الفني </p>
                                </a>
                            </li>
                        </ul>
                    </li>-->
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

