<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- ////////////////////////// pdf ///////////////////////// --}}
    <div class="row">
        <div class="col-12">
            <div class="invoice p-3 mb-3">
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        مكتب المحامي
                        <address>
                            <strong><span class="pdf-title">ثامر بن ساري العنزي</span></strong><br>
                            للمحاماه والاستشارات القانونية<br>
                            ترخيص رقم 40 / 895<br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col text-center">
                        <img src="{{ asset('webassets/dist/img/logo2.png') }}" style="width: 120px" />
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col text-left">
                        Office of Lawyer
                        <address>
                            <strong><span class="pdf-title">Thamer Sari Alenazi</span></strong><br>
                            Advocates & Legal Consultants<br>
                            Lisence No : 895 / 40<br>
                        </address>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row invoice-content">
                    <div class="col-12 bg-white">
                        <div style="height: 500px"> {{-- content goes here dont forget to remove height --}} </div>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-7 invoice-col">
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-5 invoice-col text-left invoice-footer bg-dark">
                        <strong><span class="pdf-footer"> الرياض : t.s.a.lawyer@gmail.com -- 055 33 8 40
                                48</span></strong><br>
                        <strong><span class="pdf-footer"> حفر الباطن : t.s.a.lawyer@gmail.com -- 055 0 66 80
                                95</span></strong><br>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>
