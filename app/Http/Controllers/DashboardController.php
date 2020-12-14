<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    /**
     * Show dashboard
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }
}
