<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;

class Entries extends Controller
{
    public function index()
    {
        return $this->view('admin.entries.index');
    }
}
