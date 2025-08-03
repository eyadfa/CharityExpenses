

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
<div class="book">

    <div class="page">

        <div style="height: 4cm; ">
            <img src="/assets/media/patterns/pattern-1.jpg" class="header-img" />
        </div>
        <div style="height: 10mm; width: 100%; margin-bottom: 60px;">
            <h2 style="width: 100%; text-align: center; ">  سند صرف</h2>
            <table style="float: left; direction: rtl">
                <tr>
                    <td> رقم السند:</td>
                    <td>1500/2023</td>
                </tr>
                <tr>
                    <td>تاريخ السند:</td>
                    <td> 15/3/2023</td>
                </tr>
            </table>
        </div>
<br/>
        <div style="height: 100mm; width: 100%; text-align: right; direction: rtl;">
            يصرف للسيد / محمد علي مبلغ وقدره 123 دولار وذلك عن توريد معدات مكتبية بتاريخ .........
        </div>

<div  style="direction: rtl;">
    <table style="float: left; direction: rtl">
        <tr>
            <td>مستلم السند</td>
            <td></td>
        </tr>

    </table>


    <table style="float: right; direction: rtl">

        <tr>
            <td> المدير المالي</td>
            <td></td>
        </tr>
    </table>
</div>



    </div>

    <!--div class="page">
        <div class="subpage">Page 2/2</div>

    </div-->
</div>

<script>
    window.print();
</script>
