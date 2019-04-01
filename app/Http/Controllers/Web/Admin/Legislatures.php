<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;

class Legislatures extends Controller
{
    public function index()
    {
        return view('admin.legislatures.index');
    }
}
