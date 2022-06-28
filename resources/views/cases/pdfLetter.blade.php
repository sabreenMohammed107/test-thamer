<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    <title>العنوان</title>
    <style>


body {
    font-family: examplefont, sans-serif;
letter-spacing: 2px;
padding-right: 0 !important;
text-align: justify; /*for arabic and space char */
   letter-spacing: 0;
}
        @page {
            header: page-header;
            /* font-family: 'examplefont' !important; */
            footer: page-footer;
            margin:0cm 0cm;
            margin-top: 300px;
            width: 100%;

            margin-bottom: 150px;


        }
        div#mastercontainer {
            font-family: examplefont, sans-serif;

    width: 100%;
    height: 100%;
    min-height: 100%;
    margin-bottom: -100px;
}

        }


        .body-page {
            padding: 35px 0 0;
            direction: rtl;
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
            padding: 5px 0;
            width: 20%;
            font-size: 10px;
            text-align: center;
            background: #032742;
            color: #fff;
            float: left;
        }

        .footer {
            padding: 5px 0;
            width: 30%;
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

<body >

    <div id="mastercontainer" class="body" >
        <span>
            <div class="body-page">
                <htmlpageheader name="page-header">
                    <div style="background: #02283f;direction: rtl;
                    padding:10px 10px;border-top: solid 5px #c0a47a  ;
                     border-bottom: solid 15px #c0a47a  ; width:100%">
                        <div dir="ltr" style="width: 25%;float: left;color: #c0a47a ;font-size:20px;padding:10px 0;text-align:left !important;margin-left:30px">
                            Office of Lawyer
                            <span style="text-align:left !important">
                                <br>
                                <strong><span>Thamer Sari Alenazi</span></strong><br>
                                <span style="font-size:20px;"> Advocates & Legal Consultants</span><br>
                                Lisence No: 895 / 40<br>
                            </span>
                        </div>
                        <div style="width: 30%;float: left;">
                            <span><img height="150" style="text-align: right;"
                                    src="{{ public_path('webassets/dist/img/logo2.png') }}" /></span>

                        </div>
                        <div style="width: 30%;float: left;color: #c0a47a ;font-size:14px;padding:20px 0">
                            مكتب المحامي
                            <span>
                                <strong><span>ثامر بن ساري العنزي</span></strong><br>
                                للمحاماة والاستشارات القانونية<br>
                                ترخيص رقم 40 / 895<br>
                            </span>
                        </div>
                        <div style="clear: both"></div>
                    </div>

        </htmlpageheader>

        <htmlpagefooter name="page-footer">
            <div style="align-items: flex-start;border-bottom: solid 15px #c0a47a;">
                <div class="footer" style="background: #02283f;text-align:right;border-radius:0  20px 0 0; padding:5px ;">
                    <strong><span> <span style="font-size: 14px; margin:1px;"> t.s.a.lawyer@gmail.com </span> <span
                                style="font-size: 14px; margin:1px"> 055 33 8 40 48 </span> <span
                                style="font-size: 14px; margin:1px">: الرياض </span> </span></strong><br>

                    <strong><span> <span style="font-size: 14px; margin:1px"> t.s.a.lawyer@gmail.com </span> <span
                                style="font-size: 14px; margin:1px"> 055 33 8 40 48 </span> <span
                                style="font-size: 14px; margin:1px"> : حفر الباطن </span> </span></strong><br></div>
               </div>
            </div>
        </htmlpagefooter>
    </div>
        </span>
        {{-- main --}}
        <div class="main" style="margin: 0com 1cm" >
            <p style="text-align: center">بسم الله الرحمن الرحيم</p>
            <p style="text-align: right;">{{$letter->title}}  /
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;


                <span>سلمه الله</span>
            </p>
            <p style="text-align: center">السلام عليكم ورحمة الله وبركاتة</p>
            {{-- <p style="text-align: right"><span style="border-bottom: 2px solid #000;
                "> : إشارة - إلحاقا </span></p> --}}
            {{-- param --}}
            <p style="text-align: right;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;</p>
                {{-- <p style="text-align: right"><span style="border-bottom: 2px solid #000;
                    "> :الطلبات </span></p> --}}
            {{-- param --}}
            <p style="text-align: right;">{{ $letter->text }}</p>

            <p style="text-align: center">ولكم جزيل الشكر</p>

            {{-- param --}}
            <p style="text-align: left;"> المحامي </p>
            {{-- param --}}
            <p style="text-align: left;font-weight: bold;padding:0;margin:0">{{ $letter->member->name ?? '' }}</p>
        </div>
</body>

</html>
