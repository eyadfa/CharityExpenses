

<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt;
        font-family: "Times New Roman", Times, serif;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;

    }

    .page {
        width: 21cm;
        height: 29.7cm;
        max-height: 29.7cm;
        min-height: 29.7cm;
        padding: 0.2cm;
        margin: 5mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);*/
    }
    .subpage {
        padding: 1cm;
        /*border: 5px red solid;*/
        /*height: 256mm;*/
        outline: 2cm #FFEAEA solid;
    }
    .header-img{
        width: 20.6cm;
        height: 40mm;
    }
    .footer-img{
        width: 20.6cm;
        height: 25mm;
    }


    @page {
        size: A4;
        margin: 0;

    }
    @media print {
        body{
            background-color:white;
        }
        .page {
            height:100vh;
            margin: 0 !important;
            overflow: hidden;
            /* margin: 0;*/
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: auto;
        }

        .header-img{
            width: 20.6cm;
            height: 40mm;
        }
        .footer-img{
            width: 20.6cm;
            height: 25mm;
        }

    }
</style>
@foreach($email->email_to as $to)
<div class="book">

    <div class="page">

        <div style="height: 4cm; ">
            <img src="{{ $header_img}}" class="header-img" />
        </div>
        <div style="height: 10mm; width: 100%;">
            <h2 style="float: right; "> السيد /{{$to->internal->name }}  {{$to->external->title }}</h2>
            <table style="float: left;">
                <tr><td> ص:{{$email->email_date}}</td></tr>
                <tr><td> {{$email->email_code}}</td></tr>
            </table>
        </div>
        <div style="width: 100%; ">
            <p style="text-align: right; font-size: 20; font-weight: 900; " > السلام عليكم ورحمة الله وبركاته </p>
        </div>

        <div  style="height: 8mm; width: 100%; background-color: #8a8a8a">
            <p  style="text-align: center; line-height: 10mm; font-size:18px; font-weight:bold; "> الموضوع / {{$email->title}}</p>
        </div>
        <div style="height: 185mm; width: 100%;">
            {!! $email->email_body !!}

        </div>



        <div style="height: 25mm;">
            <img src="{{ $footer_img}}" class="footer-img" />
        </div>


    </div>
    @endforeach
    <!--div class="page">
        <div class="subpage">Page 2/2</div>

    </div-->
</div>

<script>
    window.print();
</script>
