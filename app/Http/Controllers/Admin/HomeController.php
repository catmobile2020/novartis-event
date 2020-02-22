<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Poll;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $rows = Poll::all();
        return view('admin.pages.home',compact('rows'));
    }
}
