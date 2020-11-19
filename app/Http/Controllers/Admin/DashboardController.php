<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class DashboardController extends Controller
{
	// dashboard index: AUTHOR (Harsh chauhan)
    public function index(Request $request)
    {

        return view('admin.dashboard.index');
    }
}