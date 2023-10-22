<?php

namespace App\Http\Controllers;

use App\Charts\UserChart;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    //
    // public function index(){
    //     return view("dashboard.index");
    // }
    public function index(UserChart $chart)
{
    return view('dashboard.index', ['chart' => $chart->build()]);
}
}