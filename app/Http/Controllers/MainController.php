<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class MainController extends Controller
{
   public function chart()
   {
       // رسم بياني للمستخدمين
       $chart1_options = [
           'chart_title' => 'Users by Day',
           'report_type' => 'group_by_date',
           'model' => 'App\Models\User',
           'group_by_field' => 'created_at',
           'group_by_period' => 'day',
           'chart_type' => 'bar',
           
       ];
       $chart1 = new LaravelChart($chart1_options);

       // رسم بياني للطلبات
       $chart2_options = [
           'chart_title' => 'Orders by Day',
           'report_type' => 'group_by_date',
           'model' => 'App\Models\Order', // اسم الموديل الخاص بالطلبات
           'group_by_field' => 'order_date',
           'group_by_period' => 'day',
           'chart_type' => 'bar',
       ];
       $chart2 = new LaravelChart($chart2_options);

       return view('chart', compact('chart1', 'chart2'));
   }
}
