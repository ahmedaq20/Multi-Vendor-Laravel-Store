<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{

    public function __construct()
    {
        // index  ال  function  ما عدا function على كل الmiddleware('auth')هانا انا بطبق ال
    // $this->middleware('auth')->except('index');


   //  فقط index  ال  function على middleware('auth')هانا انا بطبق ال

    // $this->middleware('auth')->only('index');

   // function  على كل الmiddleware('auth')هانا انا بطبق ال
    $this->middleware('auth');

    }
    public function index(){

        return view('dashboard.dashboard');
    }
}

