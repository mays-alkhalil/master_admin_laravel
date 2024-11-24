@extends('layouts.app')
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
