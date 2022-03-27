@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> القضايا</h3>

                </div>
                <!-- /.card-header -->
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i> قضايا التنفيذ
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-primary">
                                        <!-- form start -->
                                        <form role="form">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">تاريخ بدايه القضيه </label>
                                                            <input type="text" autocomplete="off"
                                                                value="{{ date('Y/m/d', strtotime($row->start_date)) }}"
                                                                name="start_date"
                                                                placeholder="{{ date('Y/m/d', strtotime($row->start_date)) }}"
                                                                class="form-control txt-rtl hijri-date-default"
                                                                id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الملف</label>
                                                            <input type="text"
                                                                value="{{ $row->file_no }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">اسم القضيه</label>
                                                            <input type="text" value="{{ $row->name }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">المحكمه</label>
                                                            <select class="custom-select" id="court_id"
                                                                name="court_id">
                                                                @foreach ($courts as $type)
                                                                    <option
                                                                        {{ $row->court_id == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الدائره</label>
                                                            <input type="text"
                                                                value="{{ $row->circle_no }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم قرار التنفيذ </label>
                                                            <input type="text"
                                                                value="{{ $row->exec_dision_no }}"
                                                                class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم سند التنفيذ </label>
                                                            <input type="text"
                                                                value="{{ $row->exec_Deed_no }}"
                                                                name="exec_dision_no" class="form-control"
                                                                id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">تاريخ سند التنفيذ </label>
                                                            <input type="text" autocomplete="off" value=""
                                                            name="start_date" class="form-control txt-rtl hijri-date-default"
                                                            id="" placeholder="{{date('Y/m/d', strtotime($row->exec_Deed_date))}}">

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الفرع</label>
                                                            <select class="custom-select dynamic"
                                                                name="branch_id" id="branch_id">
                                                                <option>اختر </option>

                                                                @foreach ($branches as $type)
                                                                    <option
                                                                        {{ $row->branch_id == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم القضيه في المحكمه</label>
                                                            <input type="text"
                                                                value="{{ $row->court_row_no }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الصفه القانونيه للمنفذ</label>
                                                            <input type="text"
                                                                value="{{ $row->client_low_description }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">نوع سند التنفيذ</label>
                                                            <select class="custom-select" id="row_type_id"
                                                                name="row_type_id">
                                                                @foreach ($caseTypes as $type)
                                                                    <option
                                                                        {{ $row->case_type_id == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->type }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @hasrole('Admin')
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="">نوع الاتعاب</label>
                                                                <select class="custom-select" id="fees_type"
                                                                    name="fees_type">
                                                                    <option
                                                                        {{ $row->fees_type == 0 ? 'selected' : '' }}
                                                                        value="0">كاش</option>
                                                                    <option
                                                                        {{ $row->fees_type == 1 ? 'selected' : '' }}
                                                                        value="1"> قسط</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endhasrole

                                                    @hasrole('Admin')
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="">قيمه الاتعاب</label>
                                                                <input type="text"
                                                                    value="{{ $row->row_fees }}" readonly
                                                                    name="row_fees" class="form-control"
                                                                    id="">
                                                            </div>
                                                        </div>
                                                    @endhasrole





                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">الوصف</label>
                                                            <textarea class="form-control" rows="3"
                                                                disabled>{{ $row->notes }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                        </form>
                                        <hr />
                                        <h5 class="ml-2">بيانات المنفذ </h5>
                                        <form role="form">
                                            <div class="card-body">
                                                <div class="row">


                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">اسم المنفذ</label>
                                                            <input type="text"
                                                                value="{{ $row->client->name ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الجنسية</label>
                                                            <select class="custom-select"
                                                                name="nationality_id" disabled>
                                                                @foreach ($nationalities as $type)
                                                                    <option
                                                                        {{ $row->client->nationality_id == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الهوية</label>
                                                            <input type="text"
                                                                value="{{ $row->client->identity_no ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">نوع الهوية</label>
                                                            <select class="custom-select"
                                                                name="identity_type_id" disabled>
                                                                <option value="0"
                                                                    {{ $row->oppon && $row->client->identity_type_id == 0 ? 'selected' : '' }}>
                                                                    Passport</option>
                                                                <option value="1"
                                                                    {{ $row->oppon && $row->client->identity_type_id == 1 ? 'selected' : '' }}>
                                                                    ID</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">تاريخ الميلاد</label>
                                                            <input type="text" autocomplete="off" readonly
                                                                @if ($row->oppon) value="{{ date('Y/m/d', strtotime($row->client->birth_date)) }}" @endif
                                                                name="birth_date"
                                                                class="form-control txt-rtl hijri-date-default"
                                                                id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">المدينة</label>
                                                            <select class="custom-select" name="city_id"
                                                                disabled>
                                                                @foreach ($cities as $type)
                                                                    <option
                                                                        {{ $row->client->city_id == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الجوال</label>
                                                            <input type="text"
                                                                value="{{ $row->client->mobile ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">البريد الالكتروني</label>
                                                            <input type="text"
                                                                value="{{ $row->client->email ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">فاكس</label>
                                                            <input type="text"
                                                                value="{{ $row->client->fax ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">هاتف</label>
                                                            <input type="text"
                                                                value="{{ $row->client->phone ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الوظيفة</label>
                                                            <input type="text"
                                                                value="{{ $row->client->job ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">العنوان</label>
                                                            <input type="text"
                                                                value="{{ $row->client->address ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </form>
                                        <hr />
                                        <h5 class="ml-2">بيانات المنفذ ضده</h5>
                                        <form role="form">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">اسم المنفذ ضده</label>
                                                            <input type="text"
                                                                value="{{ $row->oppon->name ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الهوية</label>
                                                            <input type="text"
                                                                value="{{ $row->oppon->identity_no ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الجنسية</label>
                                                            <select class="custom-select"
                                                                name="nationality_id" disabled>
                                                                @foreach ($nationalities as $type)
                                                                    <option
                                                                        {{ $row->oppon && $row->oppon->nationality_id == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">تاريخ الميلاد</label>
                                                            <input type="text" autocomplete="off"
                                                                @if ($row->oppon) value="{{ date('Y/m/d', strtotime($row->oppon->birth_date)) }}" @endif
                                                                name="birth_date"
                                                                class="form-control txt-rtl hijri-date-default"
                                                                id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">نوع الهوية</label>
                                                            <select class="custom-select"
                                                                name="identity_type_id" disabled>
                                                                <option value="0"
                                                                    {{ $row->oppon && $row->oppon->identity_type_id == 0 ? 'selected' : '' }}>
                                                                    Passport</option>
                                                                <option value="1"
                                                                    {{ $row->oppon && $row->oppon->identity_type_id == 1 ? 'selected' : '' }}>
                                                                    ID</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">العنوان</label>
                                                            <input type="text"
                                                                value="{{ $row->oppon->address ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">المدينة</label>
                                                            <select class="custom-select" name="city_id"
                                                                disabled>
                                                                @foreach ($cities as $type)
                                                                    <option
                                                                        {{$row->oppon && $row->oppon->city_id == $type->id ? 'selected' : '' }}
                                                                        value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">رقم الجوال</label>
                                                            <input type="text"
                                                                value="{{ $row->oppon->mobile ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">البريد الالكتروني</label>
                                                            <input type="text"
                                                                value="{{ $row->oppon->email ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">هاتف</label>
                                                            <input type="text"
                                                                value="{{ $row->oppon->phone ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">فاكس</label>
                                                            <input type="text"
                                                                value="{{ $row->oppon->fax ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">الوظيفة</label>
                                                            <input type="text"
                                                                value="{{ $row->oppon->job ?? '' }}"
                                                                class="form-control" id="" disabled>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>

                                        <div class="card-footer">


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.col -->


            @endsection

            @section('scripts')

                <script>
                    function test() {
                        var attach = $('input[name="attach"]').val();


                        var link = document.createElement("a");
                        link.download = 'attach';
                        link.href = attach;
                        link.click();
                    }

                    $(document).ready(function() {

                        tinymce.init({
                            selector: 'textarea.content',
                            toolbar: 'undo redo | formatselect | ' +
                                'bold italic forecolor backcolor | alignleft aligncenter ' +
                                'alignright alignjustify | bullist numlist outdent indent | ' +
                                'removeformat |forecolor backcolor',
                            statusbar: false,
                            plugins: [
                                'textcolor', 'advlist autolink lists link image charmap print preview anchor',
                                'searchreplace visualblocks code fullscreen',
                                'insertdatetime media table paste code help wordcount '
                            ],

                            menubar: false,
                            init_instance_callback: "insert_contents",
                            height: "480",
                        });
                    });
                    tinymce.init({
                        selector: 'textarea.content2',
                        toolbar: 'undo redo | formatselect | ' +
                            'bold italic forecolor backcolor | alignleft aligncenter ' +
                            'alignright alignjustify | bullist numlist outdent indent | ' +
                            'removeformat |forecolor backcolor',
                        statusbar: false,
                        plugins: [
                            'textcolor', 'advlist autolink lists link image charmap print preview anchor',
                            'searchreplace visualblocks code fullscreen',
                            'insertdatetime media table paste code help wordcount '
                        ],

                        menubar: false,
                        init_instance_callback: "insert_contents3",
                        height: "480",
                    });

                    tinymce.init({
                        selector: 'textarea.content3',
                        toolbar: 'undo redo | formatselect | ' +
                            'bold italic forecolor backcolor | alignleft aligncenter ' +
                            'alignright alignjustify | bullist numlist outdent indent | ' +
                            'removeformat |forecolor backcolor',
                        statusbar: false,
                        plugins: [
                            'textcolor', 'advlist autolink lists link image charmap print preview anchor',
                            'searchreplace visualblocks code fullscreen',
                            'insertdatetime media table paste code help wordcount '
                        ],

                        menubar: false,
                        init_instance_callback: "insert_contents3",
                        height: "480",
                    });


                    function insert_contents(inst) {
                        inst.setContent(
                            `  <p dir="rtl"><h1 style="text-align: center;">مذكرة جوابية</h1>
<p style="text-align: right;">
    <b >/فضيلة </b> <p style="text-align: left;">سلمه الله</p>
</p>
<h3 style="text-align: center;">السلام عليكم و رحمة الله و بركاته</h3>
<p style="text-align: right;">
    <b >:إشارة إلى الدعوى </b>
</p></p>`);
                    }
                </script>

            @endsection
