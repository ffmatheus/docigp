<?php
namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;

class Home extends Controller
{
    public function index()
    {
        return view('admin.home.index');
    }
}