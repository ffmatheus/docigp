<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;

class Entries extends Controller
{
    public function index()
    {
        return view('admin.entries.index');
    }
}
