@extends('layouts.master')

@section('title', 'Charts')
@section('content')
<style>
    .chart-container {
        width: 45%; /* كل رسم بياني يأخذ 45% من العرض */
        display: inline-block; /* عرض الرسوم بجانب بعضها */
        margin: 20px; /* مسافة بين الرسوم */
        border: 2px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
        padding: 15px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        font-size: 18px;
        margin-bottom: 20px;
    }
    h2 {
        color: #333;
        font-size: 40px;
        margin-top: 20px;
        padding-left: 20px;
    }
    p {
        color: gray;
        font-size: 16px;
        margin-bottom: 20px;
        padding-left: 25px;
    }

    /* إعدادات الاستجابة لأحجام الشاشات الكبيرة مثل الأيباد */
    @media (max-width: 1024px) {
        .chart-container {
            width: 48%; /* عرض الرسوم على الأيباد يكون 48% بدلاً من 45% */
            margin: 10px; /* تقليل المسافة بين الرسوم */
        }

        h2 {
            font-size: 36px; /* تصغير حجم العنوان قليلاً ليتناسب مع الشاشات المتوسطة */
        }

        p {
            font-size: 14px; /* تقليل حجم النص قليلاً */
            padding-left: 20px; /* تعديل التباعد */
        }
    }

    /* إعدادات الاستجابة للشاشات الصغيرة مثل الهواتف */
    @media (max-width: 768px) {
        .chart-container {
            width: 100%; /* الرسم يأخذ عرض الصفحة بالكامل */
            margin: 10px 0; /* مسافة صغيرة بين الرسوم */
        }

        h2 {
            font-size: 30px; /* تصغير حجم العنوان */
        }

        p {
            font-size: 14px; /* تصغير حجم النص */
            padding-left: 15px; /* تقليل التباعد */
        }
    }

    /* إعدادات الاستجابة للأحجام الصغيرة جدًا مثل الهواتف */
    @media (max-width: 480px) {
        h2 {
            font-size: 24px; /* تصغير العنوان أكثر للشاشات الصغيرة جدًا */
        }

        p {
            font-size: 12px; /* تصغير النصوص التوضيحية */
        }
    }
</style>

<h2>Charts</h2>
<p>Charts showing data trends</p>

<div class="chart-container">
    <h1>{{ $chart1->options['chart_title'] }}</h1>
    {!! $chart1->renderHtml() !!}
</div>

<div class="chart-container">
    <h1>{{ $chart2->options['chart_title'] }}</h1>
    {!! $chart2->renderHtml() !!}
</div>

{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
{!! $chart2->renderJs() !!}
@endsection
