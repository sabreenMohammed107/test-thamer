<div class="card-body">
    <form role="form">
        <div class="card-body">
            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">اسم العميل</label>
                        <input type="text"
                            class="form-control" value="{{$client->name }}" name="name" id="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">الجنسية</label>
                        <select class="custom-select" name="nationality_id">
                            @foreach ($nationalities as $type)
                                <option
                                    {{ $client->nationality_id == $type->id ? 'selected' : '' }}
                                    value="{{ $type->id }}">
                                    {{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">رقم الهوية</label>
                        <input type="text"
                            class="form-control" value="{{ $client->identity_no }}" name="identity_no" id="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">نوع الهوية</label>
                        <select class="custom-select" name="identity_type_id">
                            <option value="0"
                                {{ $client->identity_type_id == 0 ? 'selected' : '' }}>
                                Passport</option>
                            <option value="1"
                                {{ $client->identity_type_id == 1 ? 'selected' : '' }}>
                                ID</option>

                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">تاريخ الميلاد</label>
                        <input type="text" autocomplete="off" value="{{date('Y/m/d', strtotime($client->birth_date))}}"
                            name="birth_date" class="form-control txt-rtl hijri-date-default"
                            id="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">المدينة</label>
                        <select class="custom-select" name="city_id">
                            @foreach ($cities as $type)
                                <option {{ $client->city_id == $type->id ? 'selected' : '' }}
                                    value="{{ $type->id }}">
                                    {{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">رقم الجوال</label>
                        <input type="text"
                            class="form-control" value="{{ $client->mobile }}" name="mobile" id="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">البريد الالكتروني</label>
                        <input type="text"
                            class="form-control" value="{{ $client->email }}" name="email" id="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">فاكس</label>
                        <input type="text"
                            class="form-control" value="{{ $client->fax }}" name="fax" id="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">هاتف</label>
                        <input type="text"
                            class="form-control" value="{{ $client->phone }}" name="phone" id="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">الوظيفة</label>
                        <input type="text"
                            class="form-control" value="{{ $client->job }}" name="job" id="">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">العنوان</label>
                        <input type="text"
                            class="form-control" value="{{ $client->address}}" name="address" id="">
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">حفظ
                التعديلات</button>
            <button type="submit"
                class="btn btn-danger">إلغاء</button>
        </div>
    </form>
</div>
