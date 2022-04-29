<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">

    <title>العنوان</title>
    <style>

        @page {
            header: page-header;
            font-family: 'Cairo' !important;
            footer: page-footer;
            margin:0cm 0cm;
            margin-top: 300px;
            width: 100%;

            margin-bottom: 150px;


        }
        div#mastercontainer {
            font-family: 'Cairo' !important;
    width: 100%;
    height: 100%;
    min-height: 100%;
    margin-bottom: -100px;
}

        }

<<<<<<< HEAD

=======
        html,
        body,
        .body {
            box-sizing: border-box;
            font-family: 'Cairo' !important;
                        font-style: normal;
            font-weight: 400;
            line-height: 1.5;
            text-align: right;
            text-align: start;
            text-decoration: none;
            text-shadow: none;
            text-transform: none;
            letter-spacing: normal;
            word-break: normal;
            word-spacing: normal;
            white-space: normal;
            line-break: auto;
        }
>>>>>>> a12d81c90ad107153ee674904b9550fef027aec4

        .body-page {
            padding: 35px 0 0;
            direction: ltr;
            /* background: #ddd; */
            width: 100%;
        }

        .dir-rtl {
            direction: rtl !important;
        }

        .dir-ltr {
            direction: ltr !important;
        }

        .float-r {
            float: right !important;
        }

        .float-l {
            float: left !important;
        }

        .header {
            padding: 25px 0;
            width: 20%;
            font-size: 10px;
            text-align: center;
            background: #032742;
            color: #fff;
            float: left;
        }

        .footer {
            padding: 5px 0;
            width: 60%;
            font-size: 10px;
            position: fixed;
            margin-top: 100px;
            text-align: center;
            background: #021625;
            color: #b1946ca2;
        }

        .report-header {
            float: right;
            width: 40%;
            display: inline-block;
        }

        .date {
            float: right;
            padding: 10px;
            width: 40%;
            font-size: 12px;
            text-align: center;
        }

        .image {
            width: 100%;
            text-align: center;
            clear: both;
            padding: 5px 50px 30px 10px;

            /* background: #021625; */
        }

        .company {
            width: 100%;
            /* background: #255; */
        }

        .name {
            background-color: #cecece;
            padding: 10px;
            margin: 10px;
            width: 95px;
            font-size: 12px;
            float: right;
        }

        .off_name {
            padding: 10 20px;
            float: right;
            width: 180px;
        }

        .rep_name {
            padding: 10px;
            display: inline-block;
            width: 200px;
            float: left;
            font-size: 12px;
            text-align: center;
            margin: 10px auto;
            background: #021625;
            color: #fff;
            clear: both;
        }

        .right {
            margin: 250px 0;
        }

        .right,
        .left {
            float: right;
            width: 50%;
        }

        tbody tr {
            background: #cecece;
        }

        thead tr th {
            font-weight: 100;
            font-size: 12px;
            padding: 10px;
        }

        tbody tr td {
            color: #222 !important;
            font-size: 12px;
            font-size: 12px;
            text-align: center;
        }

        .main {
            font-size: 16px;
            color: #333;
        }

        .main p {
            font-weight: 400;
            padding: 10px 0;
        }

    </style>
</head>
<?php

// $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
// $fontDirs = $defaultConfig['fontDir'];

// $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
// $fontData = $defaultFontConfig['fontdata'];

// $mpdf = new \Mpdf\Mpdf([
//     'fontDir' => array_merge($fontDirs, [

//         __DIR__ . '/webassets/dist/fonts',
//     ]),
//     'fontdata' => $fontData + [
//         'frutiger' => [
//             'R' => 'Roboto-Regular.ttf',
//             'I' => 'Roboto-Bold.ttf',
//         ]
//     ],
//     'default_font' => 'frutiger'
// ]);
?>
<body style="font-family: 'Cairo', sans-serif !important;">

    <div id="mastercontainer" class="body">
        <span>
            <div class="body-page">
                <htmlpageheader name="page-header">
                    <div style="background: #02283f;direction: rtl;
                    padding:10px 10px;border-top: solid 5px #c0a47a  ;
                     border-bottom: solid 15px #c0a47a  ; width:100%">
                        <div style="width: 32%;float: left;color: #c0a47a ;font-size:18px;padding:20px 0;text-align:left !important">
                            Office of Lawyer
                            <span style="text-align:left !important">
                                <br>
                                <strong><span>Thamer Sari Alenazi</span></strong><br>
                                <span style="font-size:14px;"> Advocates & Legal Consultants</span><br>
                                Lisence No: 895 / 40<br>
                            </span>
                        </div>
                        <div style="width: 30%;float: left;">
                            <span><img height="200" style="text-align: right;"
                                    src="{{ public_path('webassets/dist/img/logo2.png') }}" /></span>

                        </div>
                        <div style="width: 30%;float: left;color: #c0a47a ;font-size:18px;padding:20px 0">
                            مكتب المحامي
                            <span>
                                <strong><span>ثامر بن ساري العنزي</span></strong><br>
                                للمحاماه والاستشارات القانونية<br>
                                ترخيص رقم 40 / 895<br>
                            </span>
                        </div>
                        <div style="clear: both"></div>
                    </div>

        </htmlpageheader>

        <htmlpagefooter name="page-footer">
            <div style="align-items: flex-start;border-bottom: solid 15px #c0a47a;">
                <div class="footer" style="background: #02283f;text-align:right;border-radius:0  30px 0 0; padding:15px ;">
                    <strong><span> <span style="font-size: 14px; margin:1px;"> t.s.a.lawyer@gmail.com </span> <span
                                style="font-size: 14px; margin:1px"> 055 33 8 40 48 </span> <span
                                style="font-size: 14px; margin:1px">: الرياض </span> </span></strong><br>
                    <br>
                    <strong><span> <span style="font-size: 14px; margin:1px"> t.s.a.lawyer@gmail.com </span> <span
                                style="font-size: 14px; margin:1px"> 055 33 8 40 48 </span> <span
                                style="font-size: 14px; margin:1px"> : حفر الباطن </span> </span></strong><br></div>
               </div>
            </div>
        </htmlpagefooter>
    </div>
        </span>
    {{-- main --}}
    <div class="main" style="margin: 0com 1cm">
        <p style="text-align: center;">بسم الله الرحمن الرحيم</p>
        <p style="text-align: right;">فضيلة /
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;

            <span>سلمه الله</span>
        </p>
        <p style="text-align: center">السلام عليكم ورحمة الله وبركاتة</p>
        <p style="text-align: right"> (&nbsp; &nbsp; &nbsp; &nbsp; ) أتقدم لفضيلتكم بطلب الاعتراض على القضية رقم</p>
        <p style="text-align: right"><span style="border-bottom: 2px solid #000;
    "> : منطوق الحكم المعترض عليه</span></p>
        {{-- param --}}
        <p style="text-align: right;">{{ $regulation->facts }}</p>
        <p style="text-align: right;"><span style="border-bottom: 2px solid #000;
            "> :من الناحية الشكلية </span></p>
        {{-- param --}}
        <p style="text-align: right;">{{ $regulation->text }}</p>

        <p style="text-align: right;"><span style="dispaly:inline_block;padding:10px;border-bottom: 2px solid #000;
    "> :من الناحية الموضوعية</span></p>
        {{-- param --}}
        <p style="text-align: right;">{{ $regulation->defenses }}</p>
        <p style="text-align: right;"><span style="dispaly:inline_block;padding:10px;border-bottom: 2px solid #000;
    "> : الطلبات </span></p>
        {{-- param --}}
        <p style="text-align: right;">{{ $regulation->requirements }}</p>
        <p style="text-align: left;font-weight: bold;"> المحامي </p>
        {{-- param --}}
        <p style="text-align: right;font-weight: bold;"></p>
    </div>
</body>

</html>
